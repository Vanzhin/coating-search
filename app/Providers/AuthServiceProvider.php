<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->registerPolicies();
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Подтверждение электронного адреса на сайте ' . env('APP_NAME'))
                ->line('Нажмите на кнопку для подтверждения учетной записи.')
                ->greeting('Привет, ' . $notifiable->name)
                ->action('Подтвердите адрес почты', $url);
        });
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = env('APP_URL') . '/password/reset/' . $token . '?email=' .  urlencode($notifiable->email);
            return (new MailMessage)
                ->subject('Сброс пароля пользователя ' . $notifiable->name . ' на сайте '. env('APP_NAME'))
                ->line('Нажмите на кнопку для сброса пароля.')
                ->greeting('Привет, ' . $notifiable->name)
                ->action('Сбросить пароль', $url);
        });

    }
}
