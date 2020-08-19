<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $guarded = ['id'];

  public function posts(): void
  {
    $this->belongsToMany('App\Post', 'tag_maps')
      ->withTimestamps();
  }
}
