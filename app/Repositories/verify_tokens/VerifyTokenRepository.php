<?php

namespace App\Repositories\verify_tokens;

use App\Models\VerifyToken;
use Illuminate\Pagination\LengthAwarePaginator;

class VerifyTokenRepository
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
     * 
     * Lógica para obtener una lista paginada de tokens de verificación
     * 
     * @return LengthAwarePaginator
     */
    public static function index(string $companyId, array $filters = [], array $params = []): LengthAwarePaginator
    {
        return IndexVerifyTokenRepository::index($companyId, $filters, $params);
    }

    /**
     * Summary of find
     * 
     * Lógica para buscar un token de verificación por su ID
     * 
     * @param mixed $id
     * @return VerifyToken|null
     * @throws \Exception
     */
    public static function show(string $companyId, string $id): VerifyToken|null
    {
        return ShowVerifyTokenRepository::show($companyId, $id);
    }

    /**
     * Summary of store
     * 
     * Lógica para crear un nuevo token de verificación
     * 
     * @param array $data
     * @return VerifyToken
     * @throws \Exception
     */
    public static function store(array $data): VerifyToken
    {
        return StoreVerifyTokenRepository::store($data);
    }

    /**
     * Summary of update
     * 
     * Lógica para actualizar un token de verificación existente
     * 
     * @param string $companyId
     * @param string $id
     * @param array $data
     * @return bool|int
     * @throws \Exception
     */
    public static function update(string $companyId, string $id, array $data): bool|int
    {
        return UpdateVerifyTokenRepository::update($companyId, $id, $data);
    }

    /**
     * Summary of delete
     * 
     * Lógica para eliminar un token de verificación por su ID
     * 
     * @param string $companyId
     * @param string $id
     * @return void
     * @throws \Exception
     */
    public static function delete(string $companyId, string $id): void
    {
        DeleteVerifyTokenRepository::delete($companyId, $id);
    }
}
