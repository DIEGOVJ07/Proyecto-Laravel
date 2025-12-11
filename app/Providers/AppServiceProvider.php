<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail; // <--- IMPORTANTE: Para interceptar la verificación
use Illuminate\Notifications\Messages\MailMessage; // <--- IMPORTANTE: Para construir el mensaje

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
            
            // Trust Railway proxies for proper session handling
            request()->server->set('HTTPS', 'on');
        }

        // Personalizar el correo de verificación
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('🔐 CodeBattle: Verifica tu correo electrónico')
                ->view('emails.verify_email', [
                    'url' => $url,
                    'notifiable' => $notifiable
                ]);
        });
    }
}