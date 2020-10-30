<?php

namespace Tests\Unit;

use App\Post as PostAlias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyPostControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {

        $post = factory(PostAlias::class)->make();
//        dd($post);
        $this->assertTrue(true);
    }
}
