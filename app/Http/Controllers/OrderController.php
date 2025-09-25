<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PaymentConfirmedNotification;
use App\Notifications\OrderStatusNotification;

class OrderController extends Controller
{
    // ================= CUSTOMER =================
    public function index()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('orders.show', compact('order'));
    }

    // ================= ADMIN =================
    public function adminIndex()
    {
        $orders = Order::with(['user', 'product'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function adminShow(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,waiting_payment,paid,processing,shipped,delivered,cancelled,returned',
        ]);

        $order->update(['status' => $request->status]);

        // Notifikasi ke customer
        $order->user->notify(new OrderStatusNotification($order));

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }

    public function updateShipping(Request $request, Order $order)
    {
        $request->validate([
            'shipping_cost' => 'required|numeric|min:0'
        ]);

        $order->update([
            'shipping_cost' => $request->shipping_cost,
            'status' => 'waiting_payment'
        ]);

        // Notifikasi ke customer
        $order->user->notify(new OrderStatusNotification($order));

        return redirect()->back()->with('success', 'Ongkir berhasil ditambahkan, menunggu pembayaran customer.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,waiting_payment,paid,processing,shipped,delivered,cancelled,returned',
            'tracking_number' => 'nullable|string|max:50'
        ]);

        $order->update([
            'status' => $request->status,
            'tracking_number' => $request->tracking_number
        ]);

        // Notifikasi ke customer
        $order->user->notify(new OrderStatusNotification($order));

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function confirmPayment(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $order->update(['status' => 'paid']);

        // kirim notifikasi ke admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new PaymentConfirmedNotification($order));
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi, tunggu verifikasi admin.');
    }
}
