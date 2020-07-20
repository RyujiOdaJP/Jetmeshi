<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ];
  }

  public function current_pw_on_db()
  {
    return Auth::user()->password;
  }

  public function current_password()
  {
    return $this->input('current_password');
  }

  public function new_password()
  {
    return $this->input('new_password');
  }

  public function change_password()
  {
    return bcrypt($this->input('new_password'));
  }
}
