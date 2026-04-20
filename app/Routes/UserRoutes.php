<?php

namespace App\Routes;

use App\Http\Controllers\UserController;
use App\Http\Middleware\SessionCompanyMiddleware;
use Illuminate\Support\Facades\Route;

class UserRoutes
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
        Route::middleware('abilities:users.read')
            ->get('/users', [UserController::class, 'index']);

        Route::middleware('abilities:users.read')
            ->get('/users/{id}', [UserController::class, 'show']);

        Route::middleware('abilities:users.write')
            ->post('/users', [UserController::class, 'store']);

        Route::middleware('abilities:users.write')
            ->put('/users/{id}', [UserController::class, 'update']);

        Route::middleware('abilities:users.delete')
            ->delete('/users/{id}', [UserController::class, 'delete']);
    }
}