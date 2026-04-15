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
        $user = UserRepository::show($companyId, $userId);

        if (!$user) {
            throw new \Exception("El usuario seleccionado no existe", 400);
        }

        if ($request->user()->id !== $user->id) {
            throw new \Exception("No tienes permisos para esta acción", 403);
        }

        $request->user()->currentAccessToken()->delete();
    }
}