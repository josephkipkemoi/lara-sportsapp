<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutBetCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'stake_amount',
        'total_odds',
        'final_payout'
    ];
}
