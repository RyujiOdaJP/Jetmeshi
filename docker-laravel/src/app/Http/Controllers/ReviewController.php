<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
// use Illuminate\Http\Request;
use App\Review;

/**
 * Store a newly created resource in storage.
 *
 * @param \App\Http\Requests\StorePost $request
 * @return \Illuminate\Http\Response
 */
class ReviewController extends Controller
{
  public function store(StorePost $request, Review $reviews, $id)
  {
    // $this->authorize('edit', $reviews);
    $reviews->user_id = $request->user()->id;
    $reviews->post_id = $id;
    $reviews->stars = $request->star;
    $reviews->review_body = $request->review_body;
    $reviews = $reviews->save();
    return redirect('post/' . $id)->with('my_status', __('レビューを投稿しました。'));
  }
}
