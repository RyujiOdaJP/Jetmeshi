<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\User;

class IndexUserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function __invoke()
  {
    // All users
    $users = User::paginate(5);
    //edit関数のcompact('users')は['users' => $users]としているのと同意です。
    return view('user.index', compact('users'));
  }
}
