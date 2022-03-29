<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'game_category',
        'kick_off_time',
        'home_team',
        'away_team',
        'odds_home',
        'odds_away'
    ];

    public function betslip()
    {
        return $this->belongsTo(Betslip::class);
    }
}
