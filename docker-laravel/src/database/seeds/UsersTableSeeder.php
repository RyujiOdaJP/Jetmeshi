<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fakerを使う
        $faker = Faker\Factory::create('ja_JP');

        //clear data
        // DB::table('users')->truncate();

        //set admim & random user
        //固定ユーザーを作成
        DB::table('users')->insert([
            'name' => 'RyujiOdaJP',
            'email' => 'ryuji.oda@gmail.com',
            'password' => bcrypt('1234'),
            'lang' => 'ja',
            'email_verified_at' => $faker->dateTime(),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
            'using_status' => true
        ]);
        DB::table('users')->insert([
            'name' => 'foo1',
            'email' => 'foo1@foo.com',
            'password' => bcrypt('1234'),
            'lang' => 'en',
            'email_verified_at' => $faker->dateTime(),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
            'using_status' => false
        ]);

        $providers = [];
        $provider_id = [];

        for($i = 0; $i < 18; $i++){
            $providers[$i] = $faker->randomElement(['Google', 'Twitter', 'Facebook']);
            if ($providers[$i] === 'Google') {
                $provider_id[$i] = 1;
            }
            elseif ($providers[$i] === 'Twitter') {
                $provider_id[$i] = 2;
            }
            elseif($providers[$i] === 'Facebook') {
                $provider_id[$i] = 3;
            }
        }

        // ランダムにユーザーを作成
        for ($i = 0; $i < 18; $i++) {
            DB::table('users')->insert([
                'name' => $faker->unique()->userName(),
                'email' => $faker->unique()->email(),
                'password' => bcrypt('1234'),
                'lang' => $faker->randomElement(['en', 'ja']),
                'email_verified_at' => $faker->dateTime(),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
                'provider_id' => $provider_id[$i],
                'provider_name' => $providers[$i],
                'using_status' => $faker->boolean(50)

            ]);
        }
    }
}
