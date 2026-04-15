<?php

namespace App\Repositories\users;

use App\Models\User;
use App\Services\logs\LogService;

class ShowUserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of show
     * Obtener los detalles de un usuario por su ID.
     * 
     * @param string $companyId
     * @param string $userId
     * @return User|null
     */
    public static function show(
        string $companyId, 
        string $userId
    ): User|null
    {
        try {
           return User::where('company_id', $companyId)
                ->where('id', $userId)->first();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("ShowUser@show: $message");
            throw new \Exception("Error al mostrar el usuario", 500);
        }
    }

    /**
     * Buscar el email del usuario para autenticarlo.
     *
     * @param string $email El email del usuario.
     * @return User|null El usuario autenticado.
     * @throws \Exception Si hay un error durante la autenticación.
    */
    public static function email(string $email): User|null
    {
        try {
            return User::where('email', $email)->first();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("ShowUser@email: $message");
            throw new \Exception("Error al mostrar el usuario", 500);
        }
    }
}
