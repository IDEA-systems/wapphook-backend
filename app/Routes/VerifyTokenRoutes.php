<?php

namespace App\Routes;

use App\Http\Controllers\VerifyTokensController;
use Illuminate\Support\Facades\Route;

class VerifyTokenRoutes
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
        Route::middleware('abilities:verify_tokens.read')
            ->get('/verify-tokens', [VerifyTokensController::class, 'index']);

        Route::middleware('abilities:verify_tokens.read')
            ->get('/verify-tokens/{id}', [VerifyTokensController::class, 'show']);

        Route::middleware('abilities:verify_tokens.write')
            ->post('/verify-tokens', [VerifyTokensController::class, 'store']);

        Route::middleware('abilities:verify_tokens.write')
            ->put('/verify-tokens/{id}', [VerifyTokensController::class, 'update']);

        Route::middleware('abilities:verify_tokens.delete')
            ->delete('/verify-tokens/{id}', [VerifyTokensController::class, 'delete']);
    }
}