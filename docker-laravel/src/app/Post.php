<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  /*
   * Declare soft dalete.
   *
   * @var array
   */
  use SoftDeletes;

  protected $table = 'posts';

  protected $dates = ['deleted_at'];

  /**
   * Declare search index.
   *  @var array
   */
  protected $fillable = [
    'title', 'cooking_time', 'budget',
  ];

  /**
   * リレーション (従属の関係).
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user() // 単数形
  {
    return $this->belongsTo('App\User')
      ->latest();
  }

  public function reviews()
  {
    return $this->hasMany('App\Review')
      ->latest();
  }
}
