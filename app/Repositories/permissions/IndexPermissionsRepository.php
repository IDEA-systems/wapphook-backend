<?php

namespace App\Repositories\permissions;

use App\Models\Permission;
use App\Models\User;
use App\Services\logs\LogService;
use Illuminate\Database\Eloquent\Collection;

class IndexPermissionsRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of index
     * Listar los permisos de un usuario por su ID.
     *
     * @param string $userId
     * @return mixed
     * 
     */
    public static function index(string $companyId, string $userId): mixed
    {
        try {
            $user = User::where('company_id', $companyId)
                ->where('id', $userId)
                ->first();

            if (!$user) {
                throw new \Exception("El usuario seleccionado no existe", 400);
            }

            return Permission::where('user_id', $user->id)->get();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("IndexPermissionsRepository@index: $message");
            throw new \Exception("IndexPermissionsRepository@index", 500);
        }
    }
}