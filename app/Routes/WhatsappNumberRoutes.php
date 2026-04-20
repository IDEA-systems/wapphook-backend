<?php

namespace App\Routes;

use App\Http\Controllers\WhatsappNumberController;
use App\Http\Middleware\SessionCompanyMiddleware;
use App\Http\Middleware\WhatsappNumberDeleteMiddleware;
use App\Http\Middleware\WhatsappNumberReadMiddleware;
use App\Http\Middleware\WhatsappNumberWriteMiddleware;
use Illuminate\Support\Facades\Route;

class WhatsappNumberRoutes
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
        Route::middleware('abilities:whatsapp_numbers.read')
            ->get('/whatsapp-numbers', [WhatsappNumberController::class, 'index']);

        Route::middleware('abilities:whatsapp_numbers.read')
            ->get('/whatsapp-numbers/{id}', [WhatsappNumberController::class, 'show']);

        Route::middleware('abilities:whatsapp_numbers.write')
            ->post('/whatsapp-numbers', [WhatsappNumberController::class, 'store']);

        Route::middleware('abilities:whatsapp_numbers.write')
            ->put('/whatsapp-numbers/{id}', [WhatsappNumberController::class, 'update']);

        Route::middleware('abilities:whatsapp_numbers.delete')
            ->delete('/whatsapp-numbers/{id}', [WhatsappNumberController::class, 'delete']);
    }
}
