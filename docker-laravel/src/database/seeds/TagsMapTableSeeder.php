<?php

use Illuminate\Database\Seeder;

class TagsMapTableSeeder extends Seeder
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
        //clear data
        // DB::table('tag_map')->truncate();

        // ランダムに記事を作成
        for ($i = 0; $i < 40; $i++) {
            DB::table('tag_map')->insert([
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
                'tag_id' => $faker->numberBetween(1, 12),
                'post_id' => $faker->numberBetween(1, 80),
                'using_status' => $faker->boolean(50)
            ]);
        }
    }
}
