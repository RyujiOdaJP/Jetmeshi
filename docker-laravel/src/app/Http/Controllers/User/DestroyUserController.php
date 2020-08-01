<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DestroyUserController extends Controller
{
  public function __invoke(Request $request, User $user)
  {
    //ここでのポイントは、DBファサードではなく、Eloquent ORM にてdelete()メソッドを実行するという事です。
    // find()メソッドに削除対象のIDを渡してインスタンスを取得し、delete()メソッドを実行する事でdeleted_atカラムにタイムスタンプが挿入.
    $this->authorize('edit', $user);
    $user = User::find($request->user->id);
    $user->delete();
    return redirect('/')->with('my_status', __('Deleted a user.'));
  }
}
