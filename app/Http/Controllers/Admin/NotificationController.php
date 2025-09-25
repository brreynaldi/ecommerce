<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function read($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return back();
    }

    public function readAll()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }

    public function readAndGo($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();

            // Jika notifikasi punya order_id, redirect ke detail order
            if (isset($notification->data['order_id'])) {
                return redirect()->route('admin.orders.show', $notification->data['order_id']);
            }
        }

        // fallback kalau tidak ada order_id
        return redirect()->route('admin.notifications.index');
    }
}
