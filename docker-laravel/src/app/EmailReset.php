<?php

declare(strict_types=1);

namespace App;

use App\Notifications\CustomChangeEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmailReset extends Model
{
  use Notifiable;

  protected $fillable = [
        'user_id',
        'new_email',
        'token',
    ];

  /**
   * メールアドレス確定メールを送信
   *
   * @param [type] $token
   */
  public function sendEmailResetNotification($token): void
  {
    $this->notify(new CustomChangeEmail($token));
  }

  /**
   * 新しいメールアドレスあてにメールを送信する.
   *
   * @param \Illuminate\Notifications\Notification $notification
   * @return string
   */
  public function routeNotificationForMail($notification)
  {
    return $this->new_email;
  }
}
