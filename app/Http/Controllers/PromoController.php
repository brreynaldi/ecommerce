<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    // ======================
    // ADMIN
    // ======================
    public function index()
    {
        $promos = Promo::latest()->paginate(10);
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'start_date'       => 'nullable|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'active'           => 'required|boolean',
        ]);

        Promo::create($request->all());

        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil ditambahkan');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'start_date'       => 'nullable|date',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'active'           => 'required|boolean',
        ]);

        $promo->update($request->all());

        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil diperbarui');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil dihapus');
    }

    // ======================
    // CUSTOMER
    // ======================
    public function customerIndex()
    {
        // hanya tampilkan promo yang aktif & punya produk terkait
        $promos = \App\Models\Product::whereHas('promo', function($q) {
            $q->where('active', 1);
        })->with('promo')->paginate(12);

        return view('promos.index', compact('promos'));
    }
}
