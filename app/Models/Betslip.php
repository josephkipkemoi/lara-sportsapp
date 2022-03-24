<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Betslip extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'game_id',
        'betslip_team_names',
        'betslip_market',
        'betslip_market_odds'
    ];

    public function game()
    {
        return $this->hasMany(Game::class);
    }
}
