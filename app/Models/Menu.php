<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = ['restaurant_id', 'menu_name', 'price', 'description'];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}

