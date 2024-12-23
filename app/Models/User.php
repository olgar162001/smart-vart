<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Invoice;
use App\Models\Package;
use App\Models\Receipt;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'has_paid',
        'Role',
        'package',
        'current_company_id',
        'last_login_time',
        'last_login_ip',
        'reg_by_yana'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'boolean'
     ];

    public function canAccessFilament():bool
    {
        return (!strcmp($this->email,'praiselemmah@gmail.com') || !strcmp($this->email,'info@yana.africa')) && $this->hasVerifiedEmail();
    }

    public function Purchase(): HasMany
    {
        return $this->hasMany(Purchase::class,'user_id');
    }

    public function Sale(): HasMany
    {
        return $this->hasMany(Sale::class, 'user_id');
    }

    public function Total(): HasMany
    {
        return $this->hasMany(Total::class, 'user_id');
    }

    public function companies(): BelongsToMany
{
    return $this->belongsToMany(Company::class, 'company_user', 'user_id', 'company_id');
}

    public function Company(): HasMany
    {
        return $this->hasMany(Company::class, 'user_id');
    }

    public function Package(): HasOne
    {
        return $this->hasOne(Package::class);
    }

    public function Invoice(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function Role(): HasOne
    {
        return $this->hasOne(Role::class);
    }

    public function Receipt(): HasMany
    {
        return $this->hasMany(Receipt::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name','email','phone'])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
