<?php
/// HomeController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // ambil semua kategori untuk dropdown
        $categories = Category::all();

        // query dasar produk
        $query = Product::query();

        // filter kategori
        if (request()->has('category') && request('category') != '') {
            $query->where('category_id', request('category'));
        }

        // sorting
        switch (request('sort')) {
            case 'low-high':
                $query->orderBy('price', 'asc');
                break;
            case 'high-low':
                $query->orderBy('price', 'desc');
                break;
            case 'bestseller':
                $query->orderBy('sold', 'desc'); // asumsi ada kolom sold
                break;
            default:
                $query->latest();
        }

        // ambil produk dengan pagination
        $products = $query->paginate(12);

        // ambil produk yang punya promo aktif
        $promos = Product::whereHas('promo', function($q) {
            $q->where('active', 1);
        })->with('promo')->take(10)->get();

        return view('home', compact('products', 'categories', 'promos'));
    }
}
