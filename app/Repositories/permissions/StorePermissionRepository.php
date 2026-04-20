<?php

namespace App\Repositories\permissions;

use App\Models\Permission;
use App\Services\logs\LogService;

class StorePermissionRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Guardar permisos para un usuario.
     *
     * @param array $data
     * @return Permission
     */
    public static function store(array $data): Permission
    {
        try {
            return Permission::create($data);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("PermissionRepository@store: $message");
            throw new \Exception('Error al guardar los permisos del usuario', 500);
        }
    }
}