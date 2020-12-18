<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Channel;
use App\User;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        /*'name' => $faker->sentence(3),
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'description' => $faker->sentence(30)*/
        
        'name' => $faker->sentence(3),
        'user_id' => User::pluck('id'),
        'description' => $faker->sentence(30)
    ];
});
