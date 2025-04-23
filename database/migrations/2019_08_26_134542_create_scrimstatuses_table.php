<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScrimstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrimstatuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('opponent_id');
            $table->string('status');
            $table->dateTime('date_time');
            $table->text('notes')->nullable();
            $table->timestamps();


            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('opponent_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scrimstatuses');
    }
}
