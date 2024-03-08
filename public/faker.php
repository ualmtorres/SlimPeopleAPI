<?php

//Generete fake data

require dirname(__DIR__) . '/vendor/autoload.php';

$faker = Faker\Factory::create('en_US');

// Setup the seed to generate always the same data
$faker->seed(1234);

// Declare an array of fake data
$fakeData = [];

// Generate 100 records of fake data
for ($i = 0; $i < 100; $i++) {
    $fakeData[] = [
        'id' => $i + 1,
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => $faker->unique()->email,
        'phoneNumber' => $faker->phoneNumber,
        'dateOfBirth' => $faker->date,
        'company' => $faker->company,
        'imageUrl' => $faker->imageUrl,
        // address as an associative array
        'address' => [
            'street' => $faker->streetName,
            'number' => $faker->buildingNumber,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
        ],
        'description' => $faker->text,
        'favoriteColors' => [
            $faker->safeColorName,
            $faker->safeColorName,
            $faker->safeColorName,
        ],
    ];
}
