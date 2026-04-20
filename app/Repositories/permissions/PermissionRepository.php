<?php

namespace App\Repositories\permissions;

use App\Models\Permission;
use App\Services\logs\LogService;

class PermissionRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Obtener los permisos de un usuario por su ID.
     *
     * @param string $userId
     * @return mixed
     */
    public static function index(string $companyId, string $userId): mixed
    {
        return IndexPermissionsRepository::index($companyId, $userId);
    }

    /**
     * Guardar permisos para un usuario.
     *
     * @param array $data
     * @return Permission
     */
    public static function store(array $data): Permission
    {
        return StorePermissionRepository::store($data);
    }
}
