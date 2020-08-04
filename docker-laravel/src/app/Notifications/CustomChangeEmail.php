<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomChangeEmail extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public $token;

  public function __construct($token)
  {
    $this->token = $token;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param mixed $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param mixed $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
    return (new MailMessage)
      ->subject('メールアドレス変更') // 件名
      ->view('emails.changeEmail') // メールテンプレートの指定
      ->action(
          'メールアドレス変更',
          url('reset', $this->token) //アクセスするURL
        );
  }

  /**
   * Get the array representation of the notification.
   *
   * @param mixed $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
        ];
  }
}
