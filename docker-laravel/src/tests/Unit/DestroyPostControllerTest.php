<?php

namespace Tests\Unit;

use App\Post as PostAlias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class DestroyPostControllerTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        dd(env('APP_ENV'), env('DB_HOST'), env('DB_CONNECTION'));
        parent::setUp();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {

        $post = factory(PostAlias::class)->make();
        dd(DB::table('users')->first()->get());
        $this->assertTrue(true);
    }
}
