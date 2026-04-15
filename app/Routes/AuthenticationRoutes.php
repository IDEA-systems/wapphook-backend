<?php

namespace App\Routes;

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

class AuthenticationRoutes
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
        Route::post('/login', [AuthenticationController::class, 'login']);
    }
}
