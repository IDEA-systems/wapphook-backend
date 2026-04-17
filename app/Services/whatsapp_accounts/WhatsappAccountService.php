<?php

namespace App\Services\whatsapp_accounts;

use App\Http\Requests\WhatsappAccountIndexRequest;
use App\Http\Requests\WhatsappAccountStoreRequest;
use App\Http\Requests\WhatsappAccountUpdateRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\WhatsappAccount;

class WhatsappAccountService
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
     * Obtener una lista paginada de cuentas de WhatsApp para una empresa específica,
     * con opciones de filtrado y ordenamiento.
     * 
     * @param WhatsappAccountIndexRequest $request
     * @param string $companyId
     * @return LengthAwarePaginator
     */
    public static function index(
        WhatsappAccountIndexRequest $request,
        string $companyId
    ): LengthAwarePaginator
    {
        return IndexWhatsappAccountService::index($request, $companyId);
    }

    /**
     * Summary of show
     * Obtener los detalles de una cuenta de WhatsApp específica utilizando su ID.
     * 
     * @param string $companyId
     * @param string $id
     * @return WhatsappAccount
     */
    public static function show(
        string $companyId,
        string $id
    ): WhatsappAccount
    {
        return ShowWhatsappAccountService::show($companyId, $id);
    }

    /**
     * Summary of store
     * Crear una nueva cuenta de WhatsApp para una empresa específica.
     * 
     * @param WhatsappAccountStoreRequest $request
     * @param string $companyId
     * @return WhatsappAccount
     */
    public static function store(
        WhatsappAccountStoreRequest $request,
        string $companyId
    ): WhatsappAccount
    {
        return StoreWhatsappAccountService::store($request, $companyId);
    }

    /**
     * Summary of update
     * Actualizar los detalles de una cuenta de WhatsApp existente utilizando su ID.
     * 
     * @param WhatsappAccountUpdateRequest $request
     * @param string $companyId
     * @param string $id
     * @return WhatsappAccount
     */
    public static function update(
        WhatsappAccountUpdateRequest $request,
        string $companyId,
        string $id
    ): WhatsappAccount
    {
        return UpdateWhatsappAccountService::update($request, $companyId, $id);
    }

    /**
     * Summary of delete
     * Eliminar una cuenta de WhatsApp específica utilizando su ID.
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
        DeleteWhatsappAccountService::delete($companyId, $id);
    }
}