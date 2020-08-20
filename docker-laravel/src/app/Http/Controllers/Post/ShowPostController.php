<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\Post;
use App\Report;
use App\Review;
use Illuminate\Support\Facades\Auth;

class ShowPostController extends PostController
{
  /**
   * Display the specified resource.
   *
   * @param int    $id
   * @param Post   $post
   * @param Review $reviews
   * @param Report $report
   * @param Report $reports
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post, Review $reviews, Report $reports)
  {
    $reviews = Review::where('post_id', $post->id)->get();
    $id_exist = Review::where('post_id', $post->id)->exists();
    $star_avg = Review::where('post_id', $post->id)->avg('stars');
    $tag_values = $post->tags()->get();
    $tag_names = [];

    foreach ($tag_values as $tag_value) {
      $tag_names[] = $tag_value->name;
    }

    // dd($reviews->toArray()['id']);
    $report_arr = [];
    $reports =
        $reports->select('review_id')->where('user_id', Auth::id())
          ->get()->toArray();

    foreach ($reports as $key => $value) {
      $report_arr[] = $value['review_id'];
    }
    return view('post.show', compact('post', 'reviews', 'id_exist', 'star_avg', 'tag_names', 'report_arr'));
  }
}
