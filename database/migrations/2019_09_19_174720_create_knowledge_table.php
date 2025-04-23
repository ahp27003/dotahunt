<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->integer('mid');
            $table->integer('carry');
            $table->integer('roamer');
            $table->integer('support');
            $table->integer('offlaner');
            $table->integer('winrate')->nullable();
            $table->integer('gpm')->nullable();
            $table->integer('xppm')->nullable(); //xp per min
            $table->integer('lasthit')->nullable();
            $table->integer('hero_dmg')->nullable();
            $table->integer('tower_dmg')->nullable();
            $table->integer('ward')->nullable();
            $table->integer('deward')->nullable();
            $table->integer('kills')->nullable();
            $table->integer('assists')->nullable();
            $table->integer('death')->nullable();
            $table->integer('matches')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('knowledge');
    }
}
