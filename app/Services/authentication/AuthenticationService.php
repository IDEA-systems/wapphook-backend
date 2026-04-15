<?php

namespace App\Services\authentication;

use Illuminate\Http\Request;


class AuthenticationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the login process.
     *
     * @param Request $request
     * @return array
     */
    public static function login(Request $request): array
    {
        return LoginService::login($request);
    }

    /**
     * Handle the logout process.
     *
     * @param Request $request
     * @return void
     */
    public static function logout(Request $request): void
    {
        LogoutService::logout($request);
    }
}