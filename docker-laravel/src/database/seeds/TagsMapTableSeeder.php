<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class TagsMapTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //Use faker
    $faker = Faker\Factory::create('ja_JP');
    //clear data
    // DB::table('tag_maps')->truncate();

    // ランダムに記事を作成
    for ($i = 0; $i < 40; $i++) {
      DB::table('tag_maps')->insert([
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
                'tag_id' => $faker->numberBetween(1, 12),
                'post_id' => $faker->numberBetween(1, 80),
                'using_status' => $faker->boolean(50),
            ]);
    }
  }
}
