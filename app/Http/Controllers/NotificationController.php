<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('notifications.index', compact('notifications'));
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

            // kalau ada redirect tujuan dari data notifikasi
            if (isset($notification->data['order_id'])) {
                return redirect()->route('orders.show', $notification->data['order_id']);
            }
        }

        return redirect()->route('notifications.index');
    }
}
