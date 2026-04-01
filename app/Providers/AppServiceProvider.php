<?php

namespace App\Providers;

use App\Interfaces\StoreWhatsappMessageInterface;
use App\Services\whatsapp_messages\StoreWhatsappMessageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            StoreWhatsappMessageInterface::class, 
            StoreWhatsappMessageService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
