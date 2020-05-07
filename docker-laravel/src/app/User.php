<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//モデルはテーブルとマッピングされたオブジェクトです。
// DB操作を行うためのクラスになります。
class User extends Authenticatable
{
    use Notifiable;

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
     * リレーション (1対多の関係)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts() // 複数形
    {
        // 記事を新しい順で取得する
        return $this->hasMany('App\Post')
        // in case of using_status==false on DB then posts will be not shown
        ->where('using_status',true)->latest();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TextPasswordReset($token));
    }

     /**
     * 現在のユーザー、または引数で渡されたIDが管理者かどうかを返す
     *
     * @param  number  $id  User ID
     * @return boolean
     */
    public function isAdmin($id = null) {
        $id = ($id) ? $id : $this->id;
        return $id == config('admin_id');
    }
}
