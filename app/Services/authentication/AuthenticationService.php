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
     * @param string $companyId
     * @param string $userId
     * @return void
     */
    public static function logout(
        Request $request, 
        string $companyId, 
        string $userId
    ): void
    {
        LogoutService::logout($request, $companyId, $userId);
    }
}