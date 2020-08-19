<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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

  public function user_id()
  {
    return
        Auth::id();
  }

  public function review_id()
  {
    return
        $this->input('review_id');
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

  public function inapproriate()
  {
    return
        $this->input('inapproriate');
  }

  public function report_arr()
  {
    return
    [
        'user_id' => $this->user_id(),
        'review_id' => $this->review_id(),
        'harmful' => $this->harmful(),
        'irrevant' => $this->irrevant(),
        'personal' => $this->personal(),
        'inappropriate' => $this->inapproriate(),
    ];
  }
}
