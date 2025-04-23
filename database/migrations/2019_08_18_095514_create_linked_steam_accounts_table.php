<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkedSteamAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_steam_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->unique()->nullable();
             $table->string('dota_id')->unique()->nullable();
            $table->string('avatar_url')->unique()->nullable();
            $table->string('profile_url')->unique()->nullable();
            $table->string('steam_name')->nullable();
            $table->string('mmr')->nullable();
            $table->json('win_lose')->nullable();
            $table->string('country')->nullable();
            $table->string('medal')->nullable();
            $table->string('leaderboard_rank')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linked_social_accounts');
    }
}
