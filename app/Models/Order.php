<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['invoice', 'product_id', 'customer_id', 'quantity', 'price', 'total'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected static function booted()
    {
        static::saving(function ($order) {
            if ($order->product) {
                $order->price = $order->product->price; // snapshot harga per gram
                $order->total = $order->quantity * $order->price;
            }
        });
    }
}
