<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Promo;

class ProductController extends Controller
{
    // ============================
    // CUSTOMER: lihat daftar & detail produk
    // ============================
    public function index()
    {
        // produk untuk customer (hanya yang stok > 0)
        $products = Product::with(['category','promo'])
            ->where('stock', '>', 0)
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // ============================
    // ADMIN CRUD
    // ============================
    public function create()
    {
        $categories = Category::all();
        $promos = Promo::where('active', 1)->get();

        return view('admin.products.create', compact('categories','promos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
            'promo_id'    => 'nullable|exists:promos,id',
        ]);

        $path = $request->file('image')?->store('products', 'public');

        Product::create($request->only([
            'name','description','price','stock','category_id','promo_id'
        ]) + ['image' => $path]);

        return redirect()->route('admin.products.index')->with('success','Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $promos = Promo::where('active', 1)->get();

        return view('admin.products.edit', compact('product','categories','promos'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
            'promo_id'    => 'nullable|exists:promos,id',
        ]);

        $path = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $path = $request->file('image')->store('products','public');
        }

        $product->update($request->only([
            'name','description','price','stock','category_id','promo_id'
        ]) + ['image' => $path]);

        return redirect()->route('products.index')->with('success','Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('products.index')->with('success','Produk berhasil dihapus');
    }

    public function adminIndex()
    {
        $products = Product::with(['category','promo'])->paginate(15);
        return view('admin.products.index', compact('products'));
    }
}
