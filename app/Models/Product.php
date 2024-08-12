<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rel_to_cat() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function rel_to_subcat() {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
    public function rel_to_color() {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function rel_to_size() {
        return $this->belongsTo(Size::class, 'size_id');
    }
    public function rel_to_inventorie() {
        return $this->belongsTo(Inventory::class, 'inventorie_id');
    }
}
