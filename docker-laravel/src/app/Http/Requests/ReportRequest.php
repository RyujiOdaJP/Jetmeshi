<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
        ];
  }

  public function harmful()
  {
    return
        $this->input('harmful');
  }

  public function irrevant()
  {
    return
        $this->input('irrevant');
  }

  public function personal()
  {
    return
        $this->input('irrevant');
  }

  public function innaproriate()
  {
    return
        $this->input('innaproriate');
  }
}
