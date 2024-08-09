<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category', 'stock'];

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_products')->withPivot('quantity', 'price');
    }
}
