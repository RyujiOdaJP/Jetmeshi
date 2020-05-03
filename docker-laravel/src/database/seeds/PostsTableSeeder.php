<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create('ja_JP');

        // ランダムに記事を作成
        for ($i = 0; $i < 40; $i++) {
            DB::table('posts')->insert([
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
                'title' => $faker->text(20),
                'image_top' => $faker->url,
                'sumnail_pc' => $faker->url,
                'sumnail_mobile' => $faker->url,
                'image_seq1' => $faker->url,
                'image_seq2' => $faker->url,
                'sequence_body' => $faker->text(200),
                'cooking_time' => $faker->numberBetween(1, 40),
                'budget' => $faker->numberBetween(100, 500),
                'user_id' => $faker->numberBetween(1, 20)
            ]);
        }
        // for ($i = 0; $i < 10; $i++) {
        //     DB::table('posts')->insert([
        //         'image_seq3' => $faker->url,
        //         'image_seq4' => $faker->url
        //     ]);
        // }
    }
}
