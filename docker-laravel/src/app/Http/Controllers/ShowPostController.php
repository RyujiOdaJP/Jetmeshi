<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use App\Review;

class ShowPostController extends PostController
{
  /**
   * Display the specified resource.
   *
   * @param int    $id
   * @param Post   $post
   * @param Review $reviews
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Post $post, Review $reviews)
  {
    $reviews = Review::where('post_id', $post->id)->get();
    $id_exist = Review::where('post_id', $post->id)->exists();
    $star_avg = Review::where('post_id', $post->id)->avg('stars');
    $tag_values = $post->tags()->get();
    $tag_names = [];

    foreach ($tag_values as $tag_value) {
      $tag_names[] = $tag_value->name;
    }
    return view('post.show', compact('post', 'reviews', 'id_exist', 'star_avg', 'tag_names'));
  }
}
