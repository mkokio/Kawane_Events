<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
            VerifyEmail::toMailUsing(function ($notifiable, $url) {
                return (new MailMessage)
                    ->greeting(__('Hello!'))
                    ->subject(__('Verify Email Address'))
                    ->line(__('Click the button below to verify your email address.'))
                    ->action(__('Verify Email Address'), $url)
                    ->salutation(__('Thank you from Kawane Events.'));
        });
    }
}
