<?php

namespace App\Repositories\users;

use App\Models\User;
use App\Services\logs\LogService;

class DeleteUserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function delete(
        string $companyId,
        string $id
    ): void
    {
        try {
            User::where('company_id', $companyId)
                ->where('id', $id)
                ->delete();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("DeleteUserRepository@delete $message");
            throw new \Exception("Error al eliminar el usuario");
        }
    }
}
