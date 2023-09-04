<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lineItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', // ID of the product associated with the line item
        'product_name', // Name of the product
        'category', // Category of the product
        'quantity', // Quantity of the product in the line item
        'price', // Price per unit for the product
    ];

    // Define relationships if needed, for example, a line item belongs to an invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
