<?php

namespace App\Routes;

use App\Http\Controllers\WebhookController;
use App\Http\Middleware\WebhookSuscribeMiddleware;
use Illuminate\Support\Facades\Route;

class WebhookRoutes
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function register()
    {
        Route::middleware([WebhookSuscribeMiddleware::class])
            ->get('/webhook/{company_id}', [WebhookController::class, 'suscribe']);
        Route::post('/webhook/{company_id}', [WebhookController::class, 'receive']);
    }
}
