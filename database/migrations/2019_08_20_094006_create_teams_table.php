<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('captain_id');
            $table->string('name')->unique();
            $table->string('area');
            $table->integer('qtty_member');
            $table->string('image');
            $table->integer('scrim')->nullable();
            $table->string('state');
            $table->string('sponsor')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('captain_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
