<?php

declare(strict_types=1);

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
  use HandlesAuthorization;

  /**
   * Create a new policy instance.
   */
  public function __construct()
  {
  }

  /**
   * 編集と削除の認可を判断する。
   *
   * @param \App\User $user  現在ログインしているユーザー
   * @param \App\User $model 現在表示しているプロフィールページのユーザー
   * @return mixed true or false
   */
  public function edit(User $user, User $model)
  {
    return $user->id == $model->id;
  }
}
