<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Use faker
        $faker = Faker\Factory::create('ja_JP');

        // ランダムに記事を作成
        for ($i = 0; $i < 40; $i++) {
            DB::table('reviews')->insert([
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),

                'user_id' => $faker->numberBetween(1, 20),
                'post_id' => $faker->numberBetween(1, 80),
                'stars' => $faker->numberBetween(1, 5),
                'review_body' => $faker->text()
            ]);
        }
    }
}
