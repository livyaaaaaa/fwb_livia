<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Userr extends Authenticatable
{
    protected $fillable = ['username', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class, 'owner_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Restaurant::class, 'favorites');
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }
}

