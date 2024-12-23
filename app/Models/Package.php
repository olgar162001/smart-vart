<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'duration', 'users_no', 'company_no'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Invoice(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
