<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class order extends Model
    {

        use HasFactory;

        public function orders(): HasMany
        {
            return $this->hasMany(order_food::class);
        }

    }
