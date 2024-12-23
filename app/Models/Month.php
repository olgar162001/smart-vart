<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Month extends Model
{
    use HasFactory;

    protected $fillable =['name'];

    public function Sale(): HasOne
    {
        return $this->hasOne(Sale::class);
    }

    public function Purchase(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    // public function Total(): HasMany
    // {
    //     return $this->hasMany(Total::class);
    // }

    public function Total(): MorphMany 
    {
        return $this->morphMany(Total::class, 'totaly');
    }
}
