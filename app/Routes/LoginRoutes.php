<?php

namespace App\Routes;

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

class LoginRoutes
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
        Route::post('/login', [AuthenticationController::class, 'login']);
    }
}