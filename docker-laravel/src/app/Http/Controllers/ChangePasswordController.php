<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
  public function __invoke(ChangePasswordRequest $request, User $user)
  {
    //現在のパスワードが正しいかを調べる
    if (!(Hash::check($request->current_password(), $request->current_pw_on_db()))) {
      return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
    }
    //現在のパスワードと新しいパスワードが違っているかを調べる
    if (strcmp($request->current_password(), $request->new_password()) == 0) {
      return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
    }
    $user->password = $request->change_password();
    $user->save();
    return redirect()->back()->with('change_password_success', 'パスワードを変更しました。');
  }
}
