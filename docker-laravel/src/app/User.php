<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

//モデルはテーブルとマッピングされたオブジェクトです。
// DB操作を行うためのクラスになります。
class User extends Authenticatable
{
  use Notifiable;
  use SoftDeletes;

  /**
   * Declare soft dalete.
   *
   * @var array
   */
  protected $table = 'users';

  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
        'name', 'email', 'password',
    ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
        'password', 'remember_token',
    ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  /**
   * リレーション (1対多の関係).
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function posts() // 複数形
  {
    // 記事を新しい順で取得する
    return $this->hasMany('App\Post')
      ->latest();
  }

  public function likes()
  {
    return $this->hasMany('App\Like');
  }

  public function likes_count($id)
  {
    return
    $this
      ->join('posts', 'users.id', '=', 'posts.user_id')
      ->join('likes', 'posts.id', '=', 'likes.post_id')
      ->where('likes', 1)
      ->where('posts.user_id', $id)
      ->select('likes')
      ->count();
  }

  public function liked_posts_by_user()
  {
    $arr =
        $this->join('posts', 'users.id', '=', 'posts.user_id')
          ->join('likes', 'posts.id', '=', 'likes.post_id')
          ->where('likes', 1)
          ->where('likes.user_id', Auth::id())
          ->select('post_id')
          ->orderBy('likes.created_at')
          ->get()->toArray();

    foreach ($arr as $post_id) {
      $post_ids[] = $post_id['post_id'];
    }
    return
    $post_ids;
  }

  public function sendPasswordResetNotification($token): void
  {
    $this->notify(new TextPasswordReset($token));
  }

  /**
   * 現在のユーザー、または引数で渡されたIDが管理者かどうかを返す.
   *
   * @param number $id User ID
   * @return bool
   */
  public function isAdmin($id = null)
  {
    $id = ($id) ? $id : $this->id;
    return $id == config('admin_id');
  }
}
