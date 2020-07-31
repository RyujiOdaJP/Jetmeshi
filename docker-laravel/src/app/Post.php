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
   *casting likes value as integer.
   * @var array
   */
//    protected $casts = [
//     'likes' => 'integer',
//     'user_id' => 'integer',
//     'post_id' => 'integer',
//    ];

  /**
   * リレーション (従属の関係).
   *
   * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsTo
   */
  public function user() // 単数形
  {
    return $this->belongsTo('App\User')
      ->latest();
  }

  /**
   * リレーション (１対多の関係).
   *
   * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::hasMany
   */
  public function reviews()
  {
    return $this->hasMany('App\Review')
      ->latest();
  }

  /**
   * リレーション (多対多の関係).
   *
   * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsToMany
   */
  public function tags()
  {
    return $this->belongsToMany('App\Tag', 'tag_maps')
      ->withTimestamps()->withPivot('tag_id');
  }

  /**
   * リレーション (１対多の関係).
   *
   * @param mixed $collumn
   * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::hasMany
   */
  public function likes($collumn = null)
  {
    return $this->hasMany('App\Like', $collumn);
  }

  /**
   * リレーション (１対多の関係).
   *
   * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::hasMany
   */
  public function likes_user_id()
  {
    return $this->hasMany('App\Like', 'user_id');
  }

  /**
   * static function getting titles for liked post on modal list.
   * @param number $id
   * @return int
   */
  public static function post_title($id)
  {
    // if ((self::select('deleted_at')->where('id', $id) == null)) {
    return
        self::select('title')
          ->where('id', $id)
          ->first()['title'] ?? null;
    // }
  }

  public static function post_thumbnail($id)
  {
    // if ((self::onlyTrashed()->where('id', $id))) {
    return
        self::select('thumbnail_mobile')
          ->where('id', $id)
          ->first()['thumbnail_mobile'] ?? null;
    // }
    // return dd(self::select('deleted_at')->where('id', $id));
  }
}
