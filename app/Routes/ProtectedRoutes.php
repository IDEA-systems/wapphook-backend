<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

class ProtectedRoutes
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function register(): void
    {
        // Rutas protegidas por autenticación
        Route::middleware('auth:sanctum')
            ->prefix('/{companyId}')
            ->group(function () {
                LogoutRoutes::register();
                WhatsappChatRoutes::register();
                WhatsappMessagesRoutes::register();
            });
    }
}
