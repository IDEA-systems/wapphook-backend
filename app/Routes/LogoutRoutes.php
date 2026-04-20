<?php

namespace App\Routes;

use App\Http\Controllers\AuthenticationController;
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
        Route::delete('/logout', [AuthenticationController::class, 'logout']);
    }
}
