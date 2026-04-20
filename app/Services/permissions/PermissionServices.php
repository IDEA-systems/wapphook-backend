<?php

namespace App\Services\permissions;

class PermissionServices
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Listar los permisos de un usuario por su ID.
     *
     * @param string $companyId
     * @param string $userId
     * @return mixed
     */
    public static function index(string $companyId, string $userId)
    {
        return IndexPermissionService::index($companyId, $userId);
    }
}
