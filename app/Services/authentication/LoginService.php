<?php

namespace App\Services\authentication;

use App\Models\User;
use App\Repositories\authentication\AuthenticationRepository;
use App\Repositories\users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of the login process.
     * Crear una nueva session para el usuario.
     *
     * @param Request $request
     * @return array
     * @throws \Exception Si hay un error durante la autenticación.
     */
    public static function login(Request $request): array
    {
        $user = UserRepository::email($request->email);
    
        if (!$user) {
            throw new \Exception('Datos incorrectos', 401);
        }

        $verifyPassword = $user->checkPassword($request->password);

        if (!$verifyPassword) {
            throw new \Exception('Datos incorrectos', 401);
        }

        $accessToken = $user->createToken('auth_token', ['*'], now()->addDays(7))->plainTextToken;

        return [
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'user' => $user,
        ];
    }
}