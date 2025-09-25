<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderNotification;

class CheckoutController extends Controller
{
    // === Checkout gabungan (1 produk / keranjang) ===
    public function index(Request $request, Product $product = null)
    {
        if ($product) {
            // jika checkout langsung dari 1 produk
            $carts = collect([
                (object)[
                    'id' => null,
                    'product' => $product,
                    'quantity' => 1
                ]
            ]);
        } else {
            // jika checkout dari keranjang
            $cartIds = $request->cart_id ?? [];
            $carts = Cart::with('product')
                ->where('user_id', Auth::id())
                ->when(!empty($cartIds), function ($q) use ($cartIds) {
                    $q->whereIn('id', $cartIds);
                })
                ->get();

            if ($carts->isEmpty()) {
                return redirect()->route('cart.index')->with('warning', 'Keranjang kosong!');
            }
        }

        $user = Auth::user();
        return view('checkout.index', compact('carts', 'user'));
    }

    // === Proses checkout gabungan ===
    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone'   => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $user = Auth::user();

        // Jika checkout 1 produk
        if ($request->has('product_id')) {
            $product = Product::findOrFail($request->product_id);

            $order = Order::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'name' => $user->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'total' => $product->final_price ?? $product->price,
                'status' => 'pending',
            ]);

            $this->notifyAdmins($order);
        }

        // Jika checkout dari keranjang
        if ($request->has('cart_id')) {
            $carts = Cart::with('product')
                ->where('user_id', $user->id)
                ->whereIn('id', $request->cart_id)
                ->get();

            foreach ($carts as $cart) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'product_id' => $cart->product_id,
                    'name' => $user->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'payment_method' => $request->payment_method,
                    'total' => $cart->product->price * $cart->quantity,
                    'status' => 'pending',
                ]);

                $this->notifyAdmins($order);

                $cart->delete();
            }
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    private function notifyAdmins($order)
    {
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderNotification($order));
        }
    }
}
