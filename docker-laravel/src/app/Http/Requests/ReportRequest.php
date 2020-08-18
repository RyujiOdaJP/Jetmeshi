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
        'reports' => 'required_without_all:harmful,irrevant,personal,innapproriate',
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
        $this->input('personal');
  }

  public function innaproriate()
  {
    return
        $this->input('innapproriate');
  }

  public function report_arr()
  {
    return
    [
        'harmful' => $this->harmful(),
        'irrevant' => $this->irrevant(),
        'personal' => $this->personal(),
        'innapropriate' => $this->innaproriate(),
    ];
  }
}
