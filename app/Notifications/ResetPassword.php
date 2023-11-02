<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    // Override the via method with the correct method signature
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(__('Hello!'))
            ->subject(__('Reset Password'))
            ->line(__('You are receiving this email because we received a password reset request for your account.'))
            ->action(__('Reset Password'), url('password/reset', $this->token))
            ->line(__('If you did not request a password reset, no further action is required.'))
            ->salutation(__('Thank you from Kawane Events.'));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}