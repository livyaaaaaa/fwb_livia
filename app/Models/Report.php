<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    public $timestamps = false;

    protected $fillable = ['reporter_id', 'target_type', 'target_id', 'reason', 'created_at'];

    protected $dates = ['created_at'];

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}

