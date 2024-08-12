<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function rel_to_color() {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function rel_to_size() {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
