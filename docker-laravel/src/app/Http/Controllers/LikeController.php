<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
  /*
   * Store a newly created 'LIKE' in storage from client through ajax.
   *
   * @param Illuminate\Http\Request $request
   * @param Like                    $likes
   * @param mixed                   $id
   * @return \Illuminate\Http\Response
   */
  use SoftDeletes;

  public function ajaxStore(Like $likes, $id)
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

      //code...
      if (!empty($likes_count['likes'])) {

      $likes->likes = 1;
      $likes->save();
      return [
        'title' => $likes->post()
          ->select('title')
          ->first()['title'],
        'img' => $likes->post()
          ->select('thumbnail_mobile')
          ->first()['thumbnail_mobile'],
    ];
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
    // dd();
    return [
        'title' => $likes->post()
          ->select('title')
          ->first()['title'],
        'img' => $likes->post()
          ->select('thumbnail_mobile')
          ->first()['thumbnail_mobile'],
    ];
  }
}
