<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //Use faker
    $faker = Faker\Factory::create('ja_JP');
    //clear data
    //  DB::table('tags')->truncate();

    //insert tags
    $tags =
            [
            '皿洗い不要',
            'レンジのみ',
            'お湯のみ',
            '食物繊維豊富',
            'ミネラル豊富',
            'ビタミン豊富',
            '低カロリー',
            '高カロリー',
            '長期保存可',
            '高タンパク',
            '低脂肪',
            '低糖質',
            ];

    for ($i = 0; $i < count($tags); $i++) {
      DB::table('tags')->insert([
            'name' => $tags[$i],
            'using_status' => $faker->boolean(50),
            ]);
    }
  }
}
