<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'merchant_id',
        'name',
        'price',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}

