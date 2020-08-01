<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// use Illuminate\Validation\Rule;

class RestoreUserRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'exists:users,email,deleted_at,NOT_NULL'
            ],
            [
                'email.exists' => '入力されたメールアドレスは使用されています。',
            ]
        ];
  }

  public function email()
  {
    return $this->input('email');
  }
}
