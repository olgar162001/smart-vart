<?php

namespace App\Models;

use App\Traits\FilterByCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory, FilterByCompany;

    public function Month(): BelongsTo
    {
        return $this->belongsTo(Month::class, 'month_id');
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
