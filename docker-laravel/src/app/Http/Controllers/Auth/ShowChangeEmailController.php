<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ShowChangeEmailController extends Controller
{
  public function __invoke()
  {
    return view('auth.emails.ChangeEmail');
  }
}
