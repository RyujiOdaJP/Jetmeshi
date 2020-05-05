<?php

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
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
        // DB::table('likes')->truncate();

        for ($i = 0; $i < 40; $i++) {
            DB::table('likes')->insert([
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
                'user_id' => $faker->numberBetween(1, 20),
                'post_id' => $faker->numberBetween(1, 80),
                'using_status' => $faker->boolean(50)
            ]);
        }
    }
}
