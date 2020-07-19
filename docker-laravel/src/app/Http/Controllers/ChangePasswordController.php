<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
  public function change_password(Request $request, User $user)
  {
    $current_pw_on_db = Auth::user()->password;
    //現在のパスワードが正しいかを調べる
    // dd($request->current_password);
    if (!(Hash::check($request->current_password, $current_pw_on_db))) {
      return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
    }

    //現在のパスワードと新しいパスワードが違っているかを調べる
    if (strcmp($request->current_password, $request->new_password) == 0) {
      return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
    }

    //パスワードのバリデーション。新しいパスワードは6文字以上、new_password_confirmationフィールドの値と一致しているかどうか。
    // $validated_data = $request->validate([
    //     'current_password' => 'required',
    //     'new_password' => 'required|string|min:6|confirmed',
    // ]);

    //パスワードを変更
    $user->password = bcrypt($request->new_password);
    $user->save();

    return redirect()->back()->with('change_password_success', 'パスワードを変更しました。');
  }
}
