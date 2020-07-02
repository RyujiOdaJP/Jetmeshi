<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
  protected $fillable = [''];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function post()
  {
    return $this->belongsTo('App\Post');
  }


  public function liked_post_ids()
  {
    return
    $this->select('post_id')
      ->where('user_id', Auth::id())
      ->where('likes', 1)
      ->get()
      ->toArray();
  }
}
