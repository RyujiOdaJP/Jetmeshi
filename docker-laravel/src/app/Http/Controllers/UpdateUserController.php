<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\User;

class UpdateUserController extends Controller
{
  public function __invoke(User $user, UpdateUserRequest $request)
  {
    $this->authorize('edit', $user);
    $user->name = $request->name();
    $user->bio = $request->bio();
    $user->twitter = $request->twitter();
    $user->instagram = $request->instagram();
    $user->github = $request->github();
    $user->facebook = $request->facebook();
    $user->image = $request->image();
    $user->save();
    return redirect('user/' . $user->id)->with('my_status', __('Updated a user.'));
  }
}
