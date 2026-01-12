<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
      public function order_details(){
        return $this->hasMany(OrderDetail::class,"order_id");
    }

    public function customer(){
        return $this->belongsTo(Customer::class,"customer_id");
    }
}
