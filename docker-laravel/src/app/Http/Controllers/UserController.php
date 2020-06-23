<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Review;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

// use app\Http\Requests\StoreUser;

class UserController extends Controller
{
    public function random($length = 8)
    {
      return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
    }

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
   * @param int  $id
   * @param User $user
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
    $user->posts = $user->posts()->paginate(6);
    $stars_avg = [];
    $rate_array =
        $user->posts()
          ->select('id')
          ->where('user_id', $user->id)
          ->get()->toArray();
    $sum = 0;
    $count = 0;
    $rate = 0;
    $tag_names = [];
    // to display seraching window
    $tags = Tag::all();

    foreach ($rate_array as $id) {
      $avg = Review::where('post_id', '=', $id['id'])->avg('stars');
      $sum += $avg;

      if ($avg != null) {
        $count++;
      }
    }

    if ($sum != 0) {
      $rate = round($sum / $count, 1);
    }

    for ($i = 0; $i < count($user->posts); $i++) {
      $names_array = [];
      $stars_avg[] = Review::where('post_id', '=', $user->posts[$i]->id)->avg('stars');
      $tag_values = $user->posts[$i]->tags()->get();

      //   if( $tag_values[$i]->name->exists()){
      foreach ($tag_values as $tag_value) {
        $names_array[] = $tag_value->name;
      }
      $tag_names[] = $names_array;
    }
    return view(
      'user.show',
      compact('user', 'stars_avg', 'tags', 'tag_names', 'rate')
    );
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int  $id
   * @param User $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    //edit the owner's profile
    $this->authorize('edit', $user);
    return view('user.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int                      $id
   * @param User                     $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    $this->authorize('edit', $user);
    $request->validate([
        'name' => 'min:1|max:30',
        'bio' => 'max:500'
        ]);
    $user->name = $request->name;
    $user->bio = $request->bio;
    $user->twitter = $request->twitter;
    $user->instagram = $request->instagram;
    $user->github = $request->github;
    $user->facebook = $request->facebook;

    $file_name = date('Y_m_d_His') . '-' . $this->random();
    $image = $request->sent_image;
    list(, $data) = explode(',', $image);
    $decoded_sumnail =
        InterventionImage::make(base64_decode($data))->resize(
          100,
          null,
          function ($constraint): void {
            $constraint->aspectRatio();
          }
        )
          ->stream('jpg', 50);

        Storage::disk('s3')->put($file_name . '_user_image', $decoded_sumnail, 'public');
        $user->image = Storage::disk('s3')->url($file_name . '_user_image');

    $user->save();
    return redirect('user/' . $user->id)->with('my_status', __('Updated a user.'));
  }

  public function unable(Request $request, User $user)
  {
    //ここでのポイントは、DBファサードではなく、Eloquent ORM にてdelete()メソッドを実行するという事です。
    // find()メソッドに削除対象のIDを渡してインスタンスを取得し、delete()メソッドを実行する事でdeleted_atカラムにタイムスタンプが挿入.
    $this->authorize('edit', $user);
    $user = User::find($request->id);
    $user->delete();
    return redirect('/')->with('my_status', __('Deleted a user.'));
  }

  public function show_change_password_form()
  {
    return view('auth.changepassword');
  }

  public function change_password(Request $request, User $user)
  {
    //現在のパスワードが正しいかを調べる
    if (!(Hash::check($request->get('current-password'), $user->password))) {
      return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
    }

    //現在のパスワードと新しいパスワードが違っているかを調べる
    if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
      return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
    }

    //パスワードのバリデーション。新しいパスワードは6文字以上、new-password_confirmationフィールドの値と一致しているかどうか。
    $validated_data = $request->validate([
        'current-password' => 'required',
        'new-password' => 'required|string|min:8|confirmed',
    ]);

    //パスワードを変更
    $user->password = bcrypt($request->get('new-password'));
    $user->save();

    return redirect()->back()->with('change_password_success', 'パスワードを変更しました。');
  }
}
