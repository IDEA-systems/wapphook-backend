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
        Route::prefix('/{companyId}')
            ->middleware([
                'auth:sanctum',
                'company.session'
            ])
            ->group(function () {
                CompanyRoutes::register();
                VerifyTokenRoutes::register();
                UserRoutes::register();
                LogoutRoutes::register();
                PermissionRoutes::register();
                WhatsappChatRoutes::register();
                WhatsappAccountRoutes::register();
                WhatsappNumberRoutes::register();
                WhatsappMessagesRoutes::register();
            });
    }
}