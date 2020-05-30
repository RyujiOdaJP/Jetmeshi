<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Route;

/**
* Store a newly created resource in storage.
*
* @param  \App\Http\Requests\StorePost $request
* @return \Illuminate\Http\Response
*/
class ReviewController extends Controller
{
//   public function show(Review $reviews)
//   {
//     return view('post.show', compact('reviews'));
//   }

  public function store(Request $request, Review $reviews, $id)
  {
    // $request->validate([
    //     'product_id' => [
    //         'required',
    //         'exists:products,id',
    //         function($attribute, $value, $fail) use($request) {

    //             // ログインしてるかチェック
    //             if(!auth()->check()) {

    //                 $fail('レビューするにはログインしてください。');
    //                 return;

    //             }}
    //         ],
    //         'stars' => 'required|integer|min:1|max:5',
    //         'review_body' => 'required|min:1|max:400'
    //     ]);
    $reviews->user_id = $request->user()->id;
    $reviews->post_id = $id;
    $reviews->stars = $request->star;
    $reviews->review_body = $request->review_body;
    $reviews->save();
  }
}
