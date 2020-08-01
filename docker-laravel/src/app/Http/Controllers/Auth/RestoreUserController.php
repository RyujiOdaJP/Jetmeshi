<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestoreUserRequest;
use App\User;

class RestoreUserController extends Controller
{
  public function __invoke(RestoreUserRequest $request, User $user)
  {
    $user->onlyTrashed()
      ->where('email', $request->email())
      ->restore();
    return redirect(route('login'))->with('my_status', 'Restored your account.');
  }
}
