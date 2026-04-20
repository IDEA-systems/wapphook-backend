<?php

namespace App\Services\permissions;

use App\Repositories\permissions\PermissionRepository;

class IndexPermissionService
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
     * @param string $userId
     * @return mixed
     */
    public static function index(string $companyId, string $userId)
    {
        return PermissionRepository::index($companyId, $userId);
    }
}
