<?php

namespace App\Routes;

use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\CompanyMiddleware;
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
        Route::middleware([CompanyMiddleware::class])
            ->delete('/logout/{userId}', [AuthenticationController::class, 'logout']);
    }
}
