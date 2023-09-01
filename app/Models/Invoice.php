<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'invoice_number',
        'category',
        'item_name',
        'quantity',
        'delivery_address',
        'postal_code',
    ];
}
