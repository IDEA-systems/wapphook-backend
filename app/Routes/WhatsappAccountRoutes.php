<?php

namespace App\Routes;

use App\Http\Controllers\WhatsappAccountController;
use App\Http\Middleware\SessionCompanyMiddleware;
use Illuminate\Support\Facades\Route;

class WhatsappAccountRoutes
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
        Route::middleware('abilities:whatsapp_accounts.read')
            ->get('/whatsapp-accounts', [WhatsappAccountController::class, 'index']);

        Route::middleware('abilities:whatsapp_accounts.read')
            ->get('/whatsapp-accounts/{id}', [WhatsappAccountController::class, 'show']);

        Route::middleware('abilities:whatsapp_accounts.write')
            ->post('/whatsapp-accounts', [WhatsappAccountController::class, 'store']);

        Route::middleware('abilities:whatsapp_accounts.write')
            ->put('/whatsapp-accounts/{id}', [WhatsappAccountController::class, 'update']);

        Route::middleware('abilities:whatsapp_accounts.delete')
            ->delete('/whatsapp-accounts/{id}', [WhatsappAccountController::class, 'delete']);
    }
}
