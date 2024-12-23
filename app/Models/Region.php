<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Region extends Model
{
    use HasFactory;

    public function Company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
