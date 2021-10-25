<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_order',
        'transaction_id',
        'user_id',
        'status',
        'status_code',
        'total',
        'payment_type',
        'payment_code',
        'pdf_url',
        'delivery_cost',
        'delivery_service',
        'reciept_number'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders', 'transaction_id', 'product_id');
    }
}
