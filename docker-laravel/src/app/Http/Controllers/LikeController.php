<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
  /**
   * Store a newly created 'LIKE' in storage from client through ajax.
   *
   * @param Illuminate\Http\Request $request
   * @param Like                    $likes
   * @param mixed                   $id
   * @return \Illuminate\Http\Response
   */
  public function ajaxstore(Request $request, Like $likes, $id)
  {
    // dd($_GET['userId']);
    $likes->user_id = Auth::id();
    $likes->post_id = $id;
    $likes_count = $likes->select('likes')
      ->where('user_id', '=', $likes->user_id)
      ->where('post_id', '=', $likes->post_id)
      ->first();
    // dd($likes_count);
    $instance = $likes->select('likes')
      ->where('user_id', '=', $likes->user_id)
      ->where('post_id', '=', $likes->post_id);

    try {
      //code...
      if ($likes_count['likes'] == null) {
        // create new like recode
      }
    } catch (\Throwable $th) {
      // ignore error of offset array
      $likes->likes = 1;
      $likes->save();
      return ['res' => $likes_count];
    }

    if ($likes_count['likes'] == 0) {
      //  unlike to like
      $instance->update(['likes' => 1]);
    //   $likes->save();
    //   dd('a');
    } else {
      // like to unlike
      $instance->update(['likes' => 0]);
      //   $likes->save();
    // dd('c');
    }
    return ['res' => $likes_count];
  }
}
