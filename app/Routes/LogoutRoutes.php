<?php

namespace App\Routes;

use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\SessionCompanyMiddleware;
use Illuminate\Support\Facades\Route;

class LogoutRoutes
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
            ->group(function () {
                Route::delete('/logout', [AuthenticationController::class, 'logout']);
            });
    }
}
