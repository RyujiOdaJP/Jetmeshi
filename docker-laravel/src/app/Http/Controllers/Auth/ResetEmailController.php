<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ResetEmailController extends Controller
{
  /**
   * メールアドレスの再設定処理.
   *
   * @param Request $request
   * @param [type]  $token
   */
  public function __invoke(Request $request, $token)
  {
    $email_resets = DB::table('email_resets')
      ->where('token', $token)
      ->first();

    // トークンが存在している、かつ、有効期限が切れていないかチェック
    if ($email_resets && !$this->tokenExpired($email_resets->created_at)) {
      // ユーザーのメールアドレスを更新
      $user = User::find($email_resets->user_id);
      $user->email = $email_resets->new_email;
      $user->save();

      // レコードを削除
      DB::table('email_resets')
        ->where('token', $token)
        ->delete();

      return redirect('/home')->with('flash_message', 'メールアドレスを更新しました！');
    }
    // レコードが存在していた場合削除
    if ($email_resets) {
      DB::table('email_resets')
        ->where('token', $token)
        ->delete();
    }
    return redirect('/home')->with('flash_message', 'メールアドレスの更新に失敗しました。');
  }

  /**
   * トークンが有効期限切れかどうかチェック.
   *
   * @param string $createdAt
   * @return bool
   */
  protected function tokenExpired($createdAt)
  {
    // トークンの有効期限は60分に設定
    $expires = 60 * 60;
    return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
  }
}
