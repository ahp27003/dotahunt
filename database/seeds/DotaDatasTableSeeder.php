<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as IlluminateFile;
use Illuminate\Support\Collection as collect;

class DotaDatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = IlluminateFile::get(database_path('data/items.json'));
        $heroes = IlluminateFile::get(database_path('data/heroes.json'));
        $hero_roles = IlluminateFile::get(database_path('data/heroes-role.json'));
        $region = IlluminateFile::get(database_path('data/region.json'));
        $abilities = IlluminateFile::get(database_path('data/abilities.json'));
        $ability_id = IlluminateFile::get(database_path('data/ability_ids.json'));
        $item_id = IlluminateFile::get(database_path('data/item_ids.json'));
        // $jsonH = json_decode($heroes, true);
        //dd($jsonH);
        //dd($jsonH['23']);

        DB::table('dota_jsons')->insert([
            'items' => $item,
            'heroes' => $heroes,
            'hero_roles' => $hero_roles,
            'region' => $region,
            'abilities' => $abilities,
            'ability_id' => $ability_id,
            'item_id' => $item_id
        ]);
    }
}
