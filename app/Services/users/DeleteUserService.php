<?php

namespace App\Services\users;

use App\Repositories\users\UserRepository;

class DeleteUserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of delete
     * Eliminar un usuario de una empresa dada
     * 
     * @param string $companyId
     * @param string $id
     * @return void
     */
    public static function delete(
        string $companyId,
        string $id
    ): void
    {
        return UserRepository::delete($companyId, $id);
    }
}
