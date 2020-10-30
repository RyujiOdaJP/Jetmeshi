<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;


$factory->define(Post::class, function (Faker $faker) {
    return [
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
        'title' => $faker->text(20),
        'image_top' => $faker->url,
        'thumbnail_pc' => $faker->url,
        'thumbnail_mobile' => $faker->url,
        'image_seq1' => $faker->url,
        'image_seq2' => $faker->url,
        'image_seq3' => $faker->url,
        'image_seq4' => $faker->url,
        'sequence_body' => $faker->text(200),
        'cooking_time' => $faker->numberBetween(1, 40),
        'budget' => $faker->numberBetween(100, 500),
        'user_id' => $faker->numberBetween(1, 20),
    ];
});
