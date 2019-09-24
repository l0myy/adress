<?php

use Faker\Generator as Faker;

$factory->define(App\Adress::class, function (Faker $faker) {

    $created = $faker->dateTimeBetween('-30 days','-1 days');
    $ip = rand(0,255) . "." . rand(0,255) . "." . rand(0,255) . "." . rand(0,255);
    return [
        'owner'=>rand(1,4),
        'ip'=> $ip,
        'port' => rand(1,8080),
        'created_at'=>$created,
        'updated_at'=>$created
    ];
});
