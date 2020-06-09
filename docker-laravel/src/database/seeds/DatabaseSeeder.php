<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(UsersTableSeeder::class);
    $this->call(PostsTableSeeder::class);
    $this->call(TagsTableSeeder::class);
    $this->call(TagsMapTableSeeder::class);
    $this->call(ReviewsTableSeeder::class);
    $this->call(LikesTableSeeder::class);
  }
}
