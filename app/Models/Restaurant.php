<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
{
    protected $fillable = ['owner_id', 'name', 'address', 'category', 'description', 'status'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}

