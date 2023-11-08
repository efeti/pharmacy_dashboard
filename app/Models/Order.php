<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'prescription',
        'product_id',
        'quantity',
        'payment_method',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
