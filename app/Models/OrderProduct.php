<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    // rel to porduct
    function rel_to_pro(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    // rel to porduct
    function rel_to_attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
