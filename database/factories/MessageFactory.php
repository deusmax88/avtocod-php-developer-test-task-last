<?php

use Faker\Generator as Faker;

$factory->define(\App\Message::class, function (Faker $faker) {
    return [
        'content' => $faker->text(),
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        }
    ];
});
