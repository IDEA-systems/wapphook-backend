<?php

namespace App\Services\users;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
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
     * Obtener la lista de usuarios de una company
     * 
     * @param PaginationRequest $request
     * @param string $companyId
     * @return LengthAwarePaginator
     */
    public static function index(
        PaginationRequest $request,
        string $companyId
    ): LengthAwarePaginator
    {
        return IndexUserService::index($request, $companyId);
    }

    /**
     * Summary of show
     * Obtener los detalles de un usuario de una compañia
     * 
     * @param string $companyId
     * @param string $id
     * @return void
     */
    public static function show(
        string $companyId, 
        string $id
    ): User
    {
        return ShowUserService::show($companyId, $id);
    }

    /**
     * Summary of store
     * Crear un usuario y asignarle permisos.
     *
     * @param UserStoreRequest $request
     * @param string $companyId
     * @return array
     */
    public static function store(
        UserStoreRequest $request,
        string $companyId
    ): array
    {
        return StoreUserService::store($request, $companyId);
    }

    /**
     * Summary of update
     * Actualizar los datos del usuario de una empresa dada
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $id
     * @return User
     */
    public static function update(
        Request $request,
        string $companyId,
        string $id
    ): User
    {
        return UpdateUserService::update($request, $companyId, $id);
    }

    /**
     * Summary of delete
     * Eliminar le usuario de una empresa dada
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
        DeleteUserService::delete($companyId, $id);
    }
}