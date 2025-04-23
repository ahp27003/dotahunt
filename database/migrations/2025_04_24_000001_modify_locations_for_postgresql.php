<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyLocationsForPostgresql extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Only run this migration if using PostgreSQL
        if (DB::connection()->getDriverName() === 'pgsql') {
            // First, create a backup of the locations table if it exists
            if (Schema::hasTable('locations')) {
                Schema::create('locations_backup', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->unsignedBigInteger('user_id');
                    $table->text('address')->nullable();
                    $table->decimal('latitude', 10, 7)->nullable();
                    $table->decimal('longitude', 10, 7)->nullable();
                    $table->timestamps();
                    
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
                
                // Copy data if there's any
                DB::statement('INSERT INTO locations_backup (id, user_id, address, timestamps) 
                              SELECT id, user_id, address, timestamps FROM locations');
                
                // Drop the original table
                Schema::dropIfExists('locations');
                
                // Create the new table with PostgreSQL compatible columns
                Schema::create('locations', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->unsignedBigInteger('user_id')->unique();
                    $table->text('address')->nullable();
                    $table->decimal('latitude', 10, 7)->nullable();
                    $table->decimal('longitude', 10, 7)->nullable();
                    $table->timestamps();
                    
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
                
                // Enable PostGIS extension if it's not already enabled
                DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');
                
                // Add a geometry column for the coordinate
                DB::statement('ALTER TABLE locations ADD COLUMN coordinate geometry(Point, 4326)');
                
                // Copy data back from backup
                DB::statement('INSERT INTO locations (id, user_id, address, timestamps) 
                              SELECT id, user_id, address, timestamps FROM locations_backup');
                
                // Drop the backup table
                Schema::dropIfExists('locations_backup');
            } else {
                // If the table doesn't exist yet, create it with PostgreSQL compatible columns
                Schema::create('locations', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->unsignedBigInteger('user_id')->unique();
                    $table->text('address')->nullable();
                    $table->decimal('latitude', 10, 7)->nullable();
                    $table->decimal('longitude', 10, 7)->nullable();
                    $table->timestamps();
                    
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
                
                // Enable PostGIS extension
                DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');
                
                // Add a geometry column for the coordinate
                DB::statement('ALTER TABLE locations ADD COLUMN coordinate geometry(Point, 4326)');
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Only run this migration if using PostgreSQL
        if (DB::connection()->getDriverName() === 'pgsql') {
            if (Schema::hasTable('locations')) {
                Schema::dropIfExists('locations');
                
                // Recreate the original MySQL-compatible table structure
                Schema::create('locations', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->unsignedBigInteger('user_id')->unique();
                    $table->point('coordinate');
                    $table->text('address');
                    $table->timestamps();
                    
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
            }
        }
    }
}
