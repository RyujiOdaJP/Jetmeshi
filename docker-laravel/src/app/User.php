<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

  public function likes_where_1()
  {
    return $this->hasMany('App\Like')
      ->where('likes', '1');
  }

//   public function reviewed_posts()
//   {
//     return
//     $this->hasMany('App\Post')
//     ->reviews();
//   }

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
