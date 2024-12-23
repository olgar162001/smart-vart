<?php

namespace App\Models;

use App\Models\User;
use App\Models\Package;
use App\Models\Receipt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'email',
        'name',
    ];

    public function User():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Package():BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function Receipt():BelongsTo
    {
        return $this->belongsTo(Receipt::class);
    }
}
