<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Review;
use App\Tag;
use App\User;

class ShowUserController extends Controller
{
  public function __invoke(User $user)
  {
    //show user's profile
    $user->posts = $user->posts()->paginate(6);
    $stars_avg = [];
    $rate_array =
          $user->posts()
            ->select('id')
            ->where('user_id', $user->id)
            ->get()->toArray();
    $sum = 0;
    $count = 0;
    $rate = 0;
    $tag_names = [];
    // to display seraching window
    $tags = Tag::all();

    foreach ($rate_array as $id) {
      $avg = Review::where('post_id', '=', $id['id'])->avg('stars');
      $sum += $avg;

      if ($avg != null) {
        $count++;
      }
    }

    if ($sum != 0) {
      $rate = round($sum / $count, 1);
    }

    for ($i = 0; $i < count($user->posts); $i++) {
      $names_array = [];
      $stars_avg[] = Review::where('post_id', '=', $user->posts[$i]->id)->avg('stars');
      $tag_values = $user->posts[$i]->tags()->get();

      //   if( $tag_values[$i]->name->exists()){
      foreach ($tag_values as $tag_value) {
        $names_array[] = $tag_value->name;
      }
      $tag_names[] = $names_array;
    }
    return view(
      'user.show',
      compact('user', 'stars_avg', 'tags', 'tag_names', 'rate')
    );
  }
}
