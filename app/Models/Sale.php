<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'discount', 'final_price']; // Tambahkan final_price

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_products')
            ->withPivot('quantity', 'price'); // Assuming a pivot table named 'sale_products'
    }
}
