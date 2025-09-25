<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name',
    'description',
    'price',
    'stock',
    'image',
    'category_id',
    'promo_id',
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    // harga akhir otomatis (kalau ada promo)
    public function getFinalPriceAttribute()
    {
        if ($this->promo && $this->promo->active) {
            return $this->price - ($this->price * ($this->promo->discount_percent / 100));
        }
        return $this->price;
    }
}
