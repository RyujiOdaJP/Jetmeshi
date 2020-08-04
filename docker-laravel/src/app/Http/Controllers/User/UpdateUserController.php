<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\User;

class UpdateUserController extends Controller
{
  public function __invoke(User $user, UpdateUserRequest $request)
  {
    $this->authorize('edit', $user);
    $user->update(
      $request->userUpdateParameters(),
    );

    return redirect('user/' . $user->id)->with('my_status', __('Updated a user.'));
  }
}
