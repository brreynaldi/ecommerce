<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Tampilkan wishlist user
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('wishlist.index', compact('wishlists'));
    }

    // Tambah produk ke wishlist
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke wishlist');
    }

    // Pindah produk ke keranjang
    public function update(Request $request, Wishlist $wishlist)
    {
        // cek user pemilik wishlist
        if ($wishlist->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        \App\Models\Cart::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $wishlist->product_id,
            ],
            ['quantity' => 1]
        );

        $wishlist->delete();

        return redirect()->route('cart.index')->with('success', 'Produk dipindahkan ke keranjang');
    }

    public function destroy(Wishlist $wishlist)
    {
        // cek user pemilik wishlist
        if ($wishlist->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $wishlist->delete();
        return redirect()->back()->with('success', 'Produk dihapus dari wishlist');
    }
}
