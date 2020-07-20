<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use App\Review; //import the post model.
use App\Tag;

class IndexPostController extends PostController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function __invoke()
  {
    $stars_avg = [];
    $tag_names = [];
    $posts = Post::latest()->Paginate(10);
    // to display seraching window
    $tags = Tag::all();

    for ($i = 0; $i < count($posts); $i++) {
      $names_array = [];
      $stars_avg[] = Review::where('post_id', '=', $posts[$i]->id)->avg('stars');
      $tag_values = $posts[$i]->tags()->get();

      foreach ($tag_values as $tag_value) {
        $names_array[] = $tag_value->name;
      }
      $tag_names[] = $names_array;
    }
    return view('post.index', compact('posts', 'stars_avg', 'tags', 'tag_names'));
  }
}
