<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  //TODO: make relation with post&user
    public function user() // 単数形
    {
      return $this->belongsTo('App\User');
      // ->latest();
    }

  public function post() // 単数形
  {
    return $this->belongsTo('App\Post');
    // ->latest();
  }

  public function reports(): void
  {
    $this->hasMany('App\Report');
  }
}
