<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details'; // ✅ matches your DB table

    protected $fillable = ['order_id', 'product_id', 'qty', 'price', 'discount'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
