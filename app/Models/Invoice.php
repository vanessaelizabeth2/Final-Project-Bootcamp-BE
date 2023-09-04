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
        'price',
        'total_price',
        'delivery_address',
        'postal_code',
    ];
    
    protected $casts = [
        'category' => 'string',
    ];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lineItems(){
        return $this->hasMany(LineItems::class);
    }
    
}
