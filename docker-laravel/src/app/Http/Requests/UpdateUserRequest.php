<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class UpdateUserRequest extends FormRequest
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
            'name' => 'min:1|max:30',
            'bio' => 'max:500',
        ];
  }

  public function name()
  {
    return $this->input('name');
  }

  public function bio()
  {
    return $this->input('bio');
  }

  public function twitter()
  {
    return $this->input('twitter');
  }

  public function instagram()
  {
    return $this->input('instagram');
  }

  public function github()
  {
    return $this->input('github');
  }

  public function facebook()
  {
    return $this->input('facebook');
  }

  public function random($length = 8)
  {
    return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
  }

  public function image()
  {
    // $no_image = 'https://cm-jetmeshi.s3-ap-northeast-1.amazonaws.com/noimage+template.jpg';
    $image = $this->input('sent_image');

    if ($image != null) {
      $file_name = date('Y_m_d_His') . '-' . $this->random();
      list(, $data) = explode(',', $image);
      $decoded_thumbnail =
              InterventionImage::make(base64_decode($data))->resize(
                300,
                null,
                function ($constraint): void {
                  $constraint->aspectRatio();
                }
              )
                ->stream('jpg', 50);

      Storage::disk('s3')->put($file_name . '_user_image', $decoded_thumbnail, 'public');
      return $this->image = Storage::disk('s3')->url($file_name . '_user_image');
    }
  }

  public function userUpdateParameters()
  {
    $param_arr = [
        'name' => $this->name(),
        'bio' => $this->bio(),
        'twitter' => $this->twitter(),
        'instagram' => $this->instagram(),
        'github' => $this->github(),
        'facebook' => $this->facebook(),
    ];

    if ($this->image() == null) {
      return $param_arr;
    }
    return $param_arr + ['image' => $this->image()];
  }
}
