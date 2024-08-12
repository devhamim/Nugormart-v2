<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // rel to billing deatils
    function rel_to_billing(){
        return $this->hasOne(Billingdetails::class, 'order_id', 'order_id');
    }

    // rel to order porduct
    function rel_to_orderpro(){
        return $this->hasMany(OrderProduct::class, 'order_id', 'order_id');
    }
}
