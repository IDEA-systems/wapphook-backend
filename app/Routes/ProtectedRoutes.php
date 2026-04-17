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
        Route::middleware('auth:sanctum')->group(function () {
            LogoutRoutes::register();
            WhatsappChatRoutes::register();
            WhatsappNumberRoutes::register();
            WhatsappMessagesRoutes::register();
        });
    }
}
