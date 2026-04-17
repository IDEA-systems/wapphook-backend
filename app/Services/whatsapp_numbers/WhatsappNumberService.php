<?php

namespace App\Services\whatsapp_numbers;

use App\Http\Requests\WhatsappNumberStoreRequest;
use App\Http\Requests\WhatsappNumberUpdateRequest;
use App\Models\WhatsappNumber;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class WhatsappNumberService
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
     * Lógica para obtener los números de whatsapp de una empresa con filtros y paginación
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $companyId
     * @return LengthAwarePaginator
    */
    public static function index(
        Request $request, 
        string $companyId
    ): LengthAwarePaginator
    {
        return IndexWhatsappNumberService::index($request, $companyId);
    }

    /**
     * Summary of show
     * Lógica para mostrar un numero de telefono de whatsapp específico
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return WhatsappNumber
     */
    public static function show(
        string $companyId, 
        string $id
    ): WhatsappNumber
    {
        return ShowWhatsappNumberService::show($companyId, $id);
    }

    /**
     * Summary of store
     * Lógica para crear un nuevo número de whatsapp para una empresa
     * 
     * @param WhatsappNumberStoreRequest $request
     * @param string $companyId
     * @throws \Exception
     * @return WhatsappNumber
    */
    public static function store(
        WhatsappNumberStoreRequest $request, 
        string $companyId
    ): WhatsappNumber
    {
        return StoreWhatsappNumberService::store($request, $companyId);
    }

    /**
     * Summary of update
     * Lógica para actualizar un número de whatsapp de una empresa
     * 
     * @param WhatsappNumberUpdateRequest $request
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return bool|int
    */
    public static function update(
        WhatsappNumberUpdateRequest $request, 
        string $companyId, 
        string $id
    ): bool|int
    {
        return UpdateWhatsappNumberService::update($request, $companyId, $id);
    }

    /**
     * Summary of delete
     * Lógica para eliminar un número de whatsapp de una empresa
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return bool|int
    */
    public static function delete(
        string $companyId, 
        string $id
    ): mixed
    {
        return DeleteWhatsappNumberService::delete($companyId, $id);
    }
}
