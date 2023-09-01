<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $table="carts";
    
    protected $fillable = [
        'product_id',
        'user_id', // Include 'user_id' in the $fillable array
        'count',
        'price',
        'total_price'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }


}