<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Total extends Model
{
    use HasFactory;

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Month(): BelongsTo
    {
        return $this->belongsTo(Month::class, 'month_id');
    }

    public function totaly(): MorphTo 
    {
        return $this->morphTo();
    }
}
