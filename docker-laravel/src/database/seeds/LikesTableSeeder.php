<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
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
                'likes' => 1,
                // 'using_status' => $faker->boolean(50),
            ]);
    }
  }
}
