<?php

namespace App\Repositories\users;

use App\Models\User;
use App\Services\logs\LogService;

class UpdateUserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
    * Summary of update
    * Actualizar los detalles de un usuario.
    * 
    * @param string $companyId
    * @param string $userId
    * @param array $data
    * @return bool|int
    */
    public static function update(
        string $companyId, 
        string $userId, 
        array $data
    ): bool|int
    {
        try {
            return User::where('company_id', $companyId)
                ->where('id', $userId)
                ->update($data);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("UpdateUser@update: $message");
            throw new \Exception("Error al actualizar el usuario", 500);
        }
    }
}
