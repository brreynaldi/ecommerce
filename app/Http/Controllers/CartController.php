<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan keranjang user
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('carts'));
    }

    // Tambah produk ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'nullable|integer|min:1'
        ]);

        $quantity = $request->quantity ?? 1;

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            // sudah ada, update quantity
            $cart->increment('quantity', $quantity);
        } else {
            // belum ada, buat baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // Update jumlah produk
   public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update(['quantity' => $request->quantity]);

        $total = $cart->quantity * $cart->product->price;

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'total' => $total
            ]);
        }

        return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui');
    }
    public function destroy(Cart $cart)
    {
        // Hapus: $this->authorize('delete', $cart);

        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $cart->delete();
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }

}
