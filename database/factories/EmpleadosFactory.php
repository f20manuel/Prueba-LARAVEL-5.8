<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Empresas;
use App\Empleados;
use Faker\Generator as Faker;

$factory->define(Empleados::class, function (Faker $faker) {

    $samsung = Empresas::where('name', 'Samsung')->first();

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_id' => $samsung->id,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->tollFreePhoneNumber,
        'created_at' => now()
    ];
});
