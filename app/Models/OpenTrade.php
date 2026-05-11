<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenTrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'pair',
        'timeframe',
        'image_path',
        'analysis',
        'entry_price',
        'target_price',
        'stop_loss',
        'amount',
        'is_active',
    ];
}
