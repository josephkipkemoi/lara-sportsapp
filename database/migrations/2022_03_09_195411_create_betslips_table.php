<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('betslips', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');

            $table->unsignedBigInteger('game_id');
            $table->string('betslip_team_names');
            $table->string('betslip_market');
            $table->bigInteger('betslip_market_odds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('betslips');
    }
};
