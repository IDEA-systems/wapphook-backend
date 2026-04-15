<?php

namespace App\Services\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class WhatsappMessageService
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
     * Obtener los mensajes de whatsapp de un chat y una compañía, con filtros y paginación.
     * 
     * @param Request $request
     * @param string $companyId
     * @return LengthAwarePaginator
     */
    public static function index(
        Request $request, 
        string $companyId
    ): LengthAwarePaginator
    {
        return IndexWhatsappMessageService::index($request, $companyId);
    }

    /**
     * Summary of show
     * Obtener un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $id
     * @return WhatsappMessage|null
     */
    public static function show(
        string $companyId,
        string $id
    ): WhatsappMessage|null
    {
        return ShowWhatsappMessageService::show($companyId, $id);
    }

     /**
     * Summary of store
     * Almacenar un nuevo mensaje de whatsapp en un chat específico para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @return WhatsappMessage|null
    */
    public static function store(
        Request $request, 
        string $companyId
    ): WhatsappMessage|null
    {
        return StoreWhatsappMessageService::store($request, $companyId);
    }

    /**
     * Summary of send
     * Enviar un nuevo mensaje de whatsapp en un chat específico para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @return void
    */
    public static function send(
        Request $request, 
        string $companyId
    ): void
    {
        SendWhatsappMessageService::send($request, $companyId);
    }

    /**
    * Summary of update
    * Actualizar un mensaje de whatsapp específico de un chat para una empresa dada.
    * 
    * @param Request $request
    * @param string $companyId
    * @param string $id
    * @return bool|int
    */
    public static function update(
        Request $request, 
        string $companyId,
        string $id
    ): bool|int
    {
        return UpdateWhatsappMessageService::update($request, $companyId, $id);
    }

     /**
     * Summary of destroy
     * Eliminar un mensaje de whatsapp específico de un chat para una empresa dada.
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
        WhatsappMessageRepository::delete($companyId, $id);
    }
}
