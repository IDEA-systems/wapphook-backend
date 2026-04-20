<?php

namespace App\Routes;

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

class PermissionRoutes
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
        Route::prefix('/permissions/{userId}')
            ->middleware('abilities:users.read')
            ->group(function () {
                Route::get('/', [PermissionController::class, 'index']);
            });
    }
}
