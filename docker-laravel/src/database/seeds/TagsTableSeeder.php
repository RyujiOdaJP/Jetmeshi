<?php

use Illuminate\Database\Seeder;
use Predis\Command\ListLength;

use function GuzzleHttp\_current_time;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear data
        // DB::table('posts')->truncate();

        //insert tags
        $tags=
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
            '低糖質'

            ];

        for ($i = 0; $i < count($tags); $i++)
        DB::table('tags')->insert([
            'name' => $tags[$i]
        ]);
    }
}
