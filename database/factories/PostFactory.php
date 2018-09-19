<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'title'=>'Premier Leguage',
        'content'=>'Chelsea win three macth',
        'user_id'=>5
    ];
});
