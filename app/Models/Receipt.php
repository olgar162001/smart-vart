<?php

namespace App\Models;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{

    protected $fillable = [
        'receipt_no',
        'email',
        'name',
    ];
    use HasFactory;

    public function User():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Invoice():BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
