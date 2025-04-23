<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [

        'captain_id' => function(){

            return factory(App\User::class)->create()->id;
        },

        'name' => $faker->sentence,
        'area' => $faker->sentence,
        'qtty_member'=> 5

    ];
});
