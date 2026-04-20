<?php

namespace App\Repositories\users;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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
     * @param string $id
     * @return User|null
     */
    public static function show(
        string $companyId, 
        string $id
    ): User|null
    {
        return ShowUserRepository::show($companyId, $id);
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
     * Summary of store
     * Crear un usuario y guardar sus permisos.
     *
     * @param array $data
     * @return User
     */
    public static function store(array $data): User
    {
        return StoreUserRepository::store($data);
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
        return UpdateUserRepository::update($companyId, $id, $data);
    }

    /**
     * Summary of delete
     * Eliminar un usuario de una compañia
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
        DeleteUserRepository::delete($companyId, $id);
    }
}
