<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //  protected $table = 'stocks';
    // protected $fillable = ['product_id', 'qty'];

    protected $table = 'stocks';
    protected $fillable = ['product_id','qty','transaction_id','parent_id','warehouse_id','expiry_date'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
