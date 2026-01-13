<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders'; // ✅ matches your DB table

    protected $fillable = ['customer_id', 'total_amount', 'discount', 'net_amount', 'status_id', 'delivery_date', 'delivery_address'];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, "order_id");
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id");
    }
}
