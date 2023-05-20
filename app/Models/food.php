<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_name',
        'price',
        'status',
        'image',
        'category_id',
    ];

    protected $attributes = [
        'status' => 1,
    ];

    public function getStatusAttribute($value)
    {
        return $value ? 'Active' : 'Disabled';
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }

}
