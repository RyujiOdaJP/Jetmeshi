<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;

class EditUserController extends Controller
{
  public function __invoke(User $user)
  {
    $this->authorize('edit', $user);
    return view('user.edit', compact('user'));
  }
}
