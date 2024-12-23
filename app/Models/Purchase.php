<?php

namespace App\Models;

use App\Traits\FilterByCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
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

    public function Company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
