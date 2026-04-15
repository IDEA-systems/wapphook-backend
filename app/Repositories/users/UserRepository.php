<?php

namespace App\Repositories\users;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
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
     * Listar los usuarios de una empresa con filtros y paginación.
     * 
     * @param string $companyId
     * @param array $filters
     * @param array $pagination
     * @return LengthAwarePaginator
     */
    public static function index(
        string $companyId, 
        array $filters = [], 
        array $pagination = []
    ): LengthAwarePaginator
    {
        return IndexUserRepository::index($companyId, $filters, $pagination);
    }

    /**
     * Summary of show
     * Obtener los detalles de un usuario por su ID.
     * 
     * @param string $companyId
     * @param string $userId
     * @return User|null
     */
    public static function show(
        string $companyId, 
        string $userId
    ): User|null
    {
        return ShowUserRepository::show($companyId, $userId);
    }

    /**
     * Buscar el email del usuario por su email.
     *
     * @param string $email El email del usuario.
     * @return User|null El usuario encontrado.
     * @throws \Exception Si hay un error durante la búsqueda.
     */
    public static function email(string $email): User|null
    {
        return ShowUserRepository::email($email);
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
        return UpdateUserRepository::update($companyId, $userId, $data);
    }
}
