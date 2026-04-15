<?php

namespace App\Routes;

use App\Http\Controllers\WhatsappMessageController;
use App\Http\Middleware\SessionCompanyMiddleware;
use App\Http\Middleware\WhatsappMessageDeleteMiddleware;
use App\Http\Middleware\WhatsappMessageReadMiddleware;
use App\Http\Middleware\WhatsappMessageWriteMiddleware;
use Illuminate\Support\Facades\Route;

class WhatsappMessagesRoutes
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
        Route::prefix('/{companyId}')->middleware([SessionCompanyMiddleware::class])
            ->group(function () {
                Route::middleware([WhatsappMessageReadMiddleware::class])
                    ->get('/whatsapp-messages', [WhatsappMessageController::class, 'index']);

                Route::middleware([WhatsappMessageReadMiddleware::class])
                    ->get('/whatsapp-messages/{id}', [WhatsappMessageController::class, 'show']);

                Route::middleware([WhatsappMessageWriteMiddleware::class])
                    ->post('/whatsapp-messages/send', [WhatsappMessageController::class, 'send']);

                Route::middleware([WhatsappMessageWriteMiddleware::class])
                    ->put('/whatsapp-messages/{id}', [WhatsappMessageController::class, 'update']);
                
                Route::middleware([WhatsappMessageDeleteMiddleware::class])
                    ->delete('/whatsapp-messages/{id}', [WhatsappMessageController::class, 'delete']);
            });
    }
}
