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
    * @param string $id
    * @param array $data
    * @return User
    */
    public static function update(
        string $companyId, 
        string $id, 
        array $data
    ): User
    {
        try {
            $userModel = User::where('company_id', $companyId)
                ->where('id', $id)
                ->first();

            $userModel->update($data);
            
            return $userModel;
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("UpdateUser@update: $message");
            throw new \Exception("Error al actualizar el usuario", 500);
        }
    }
}
