<?php

use App\Contacts;
use Faker\Generator as Faker;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Contacts::class, function (Faker $faker) {
    return [
        'team_id' => 1,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => '+1'.mt_rand(1000000000, 9999999999),
				'sticky_phone_number_id' => $faker->unique()->userName,
        'twitter_id' => $faker->unique()->userName,
        'fb_messenger_id' => $faker->unique()->userName,
        'unsubscribed_status' => $faker->randomElement(['none', 'partial', 'paused', 'all']),
    ];
});

$factory->state(Contacts::class, 'subscribed', function (Faker $faker) {
    return [
        'unsubscribed_status' => Contact::UNSUB_NONE,
    ];
});

$factory->state(Contacts::class, 'unsubscribed', function (Faker $faker) {
    return [
        'unsubscribed_status' => Contact::UNSUB_ALL,
    ];
});
