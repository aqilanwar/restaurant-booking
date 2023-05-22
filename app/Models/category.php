<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $attributes = [
        'status' => 1,
    ];

    public function getStatusAttribute($value)
    {
        return $value ? 'Active' : 'Disabled';
    }

    public function foods()
    {
        return $this->hasMany(food::class);
    }

}
