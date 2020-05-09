<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use app\Http\Requests\StoreUser;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //User-me
        $users = User::paginate(5);
        //edit関数のcompact('users')は['users' => $users]としているのと同意です。
        return view('user.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * $user変数がApp\User Eloquentモデルとしてタイプヒントされており、
     * 変数名が{user} URIセグメントと一致しているため、
     * Laravelは、リクエストされたURIの対応する値に一致するIDを持つ、
     * モデルインスタンスを自動的に注入します。
     * 一致するモデルインスタンスがデータベースへ存在しない場合、
     * 404 HTTPレスポンスが自動的に生成されます。
     */
    public function show(User $user)
    {
        //show user's profile
        $user->posts = $user->posts()->paginate(5);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //edit the owner's profile
        $this->authorize('edit', $user);
        return view('user.edit', compact($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $this->authorize('edit', $user);

        // name欄だけを検査するため、元のStoreUserクラス内のバリデーション・ルールからname欄のルールだけを取り出す。
        $request->validate([
            'name' => (new StoreUser())->rules()['name']
            ]);
        $user->name = $request->name;
        $user->save();
        return redirect('user/' . $user->id)->with('my_status', __('Updated a user.'));
    }

    public function unable(Request $request, User $user)
    {
        //ここでのポイントは、DBファサードではなく、Eloquent ORM にてdelete()メソッドを実行するという事です。
        // find()メソッドに削除対象のIDを渡してインスタンスを取得し、delete()メソッドを実行する事でdeleted_atカラムにタイムスタンプが挿入.
        // $this->authorize('edit', $user);
        $user = User::find($request->id);
        $user->delete();
        return redirect('home')->with('my_status', __('Deleted a user.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(User $user)
    // {
    //     //
    //     $this->authorize('edit', $user);
    //     //need to change delete() to other method later
    //     $user->using_status = false;
    //     return redirect('/')->with('my_status', __('Deleted a user.'));
    // }
}
