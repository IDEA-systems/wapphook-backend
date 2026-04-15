<?php

namespace App\Services\authentication;

use App\Repositories\authentication\AuthenticationRepository;
use App\Repositories\users\UserRepository;
use Illuminate\Http\Request;

class LogoutService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the logout process.
     *
     * @param Request $request
     * @return void
     */
    public static function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}