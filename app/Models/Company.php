<?php

namespace App\Models;

use App\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id','region', 'address', 'company_pic'];  

    public function Purchase():HasMany
    {
        return $this->hasMany(Purchase::class, 'company_id');
    }

    public function User():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_user');
    }

    public function Region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
