<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDotaJsonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dota_jsons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('items')->nullable();
            $table->longText('heroes')->nullable();
            $table->longText('hero_roles')->nullable();
            $table->longText('region')->nullable();
            $table->longText('abilities')->nullable();
            $table->longText('ability_id')->nullable();
            $table->longText('item_id')->nullable();
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
        Schema::dropIfExists('dota_jsons');
    }
}
