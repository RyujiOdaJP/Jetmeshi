<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class ShowChangePasswordController extends Controller
{
  public function __invoke()
  {
    return view('auth.changepass');
  }
}
