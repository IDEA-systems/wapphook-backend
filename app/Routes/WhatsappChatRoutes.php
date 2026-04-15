<?php

namespace App\Routes;

use App\Http\Controllers\WhatsappChatController;
use App\Http\Middleware\SessionCompanyMiddleware;
use App\Http\Middleware\WhatsappChatDeleteMiddleware;
use App\Http\Middleware\WhatsappChatReadMiddleware;
use App\Http\Middleware\WhatsappChatWriteMiddleware;
use Illuminate\Support\Facades\Route;

class WhatsappChatRoutes
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
        Route::prefix('/{companyId}')
            ->middleware([SessionCompanyMiddleware::class])
            ->group(function() {
                Route::middleware([WhatsappChatReadMiddleware::class])
                    ->get('/whatsapp-chats', [WhatsappChatController::class, 'index']);

                Route::middleware([WhatsappChatReadMiddleware::class])
                    ->get('/whatsapp-chats/{id}', [WhatsappChatController::class, 'show']);

                Route::middleware([WhatsappChatReadMiddleware::class])
                    ->get('/whatsapp-chats/{id}/messages', [WhatsappChatController::class, 'messages']);

                Route::middleware([WhatsappChatWriteMiddleware::class])
                    ->put('/whatsapp-chats/{id}', [WhatsappChatController::class, 'update']);

                Route::middleware([WhatsappChatDeleteMiddleware::class])
                    ->delete('/whatsapp-chats/{id}', [WhatsappChatController::class, 'delete']);
            });
    }
}