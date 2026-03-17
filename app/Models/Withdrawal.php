<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'amount',
        'status',
        'approved_at',
        'reason',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}

