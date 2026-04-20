<?php

namespace App\Repositories\users;

use App\Models\User;
use App\Repositories\permissions\PermissionRepository;
use App\Services\logs\LogService;
use Illuminate\Support\Facades\DB;

class StoreUserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of store
     * Crear un usuario y asignar permisos.
     *
     * @param array $data
     * @return User
     */
    public static function store(array $data): User
    {
        try {
            return User::create($data);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("StoreUserRepository@store: $message");
            throw new \Exception('Error al crear el usuario', 500);
        }
    }
}
