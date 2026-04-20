<?php

namespace App\Services\users;

use App\Models\User;
use App\Repositories\users\UserRepository;
use Illuminate\Http\Request;

class UpdateUserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function update(
        Request $request,
        string $companyId,
        string $id
    ): User
    {
        $userData = UserRepository::show($companyId, $id);

        if (!$userData) {
            throw new \Exception("El usuario seleccionado no existe", 400);
        }

        $name = $request->input('name', $userData->name);
        $email = $request->input('email', $userData->email);
        $password = $request->input('password', $userData->password);

        return UserRepository::update($companyId, $id, [
            "name" => $name,
            "email" => $email,
            "password" => $password
        ]);
    }
}
