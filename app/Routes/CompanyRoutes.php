<?php

namespace App\Routes;

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

class CompanyRoutes
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
        Route::middleware('abilities:companies.read')
            ->get('/', [CompanyController::class, 'show']);

        Route::middleware('abilities:companies.write')
            ->put('/', [CompanyController::class, 'update']);

        Route::middleware('abilities:companies.delete')
            ->delete('/', [CompanyController::class, 'delete']);
    }
}