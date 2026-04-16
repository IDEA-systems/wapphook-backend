<?php

namespace App\Routes;

use App\Http\Controllers\WebhookController;
use App\Http\Middleware\WebhookCompanyMiddleware;
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
        Route::prefix('/{companyId}')
            ->middleware([WebhookCompanyMiddleware::class])
            ->group(function () {
                Route::get('/webhook', [WebhookController::class, 'suscribe']);
                Route::post('/webhook', [WebhookController::class, 'receive']);
            });
    }
}
