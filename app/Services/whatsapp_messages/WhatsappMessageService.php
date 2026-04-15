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
     * @param string $whatsappChatId
     * @return LengthAwarePaginator
     */
    public static function index(
        Request $request, 
        string $companyId, 
        string $whatsappChatId
    ): LengthAwarePaginator
    {
        return IndexWhatsappMessageService::index($request, $companyId, $whatsappChatId);
    }

    /**
     * Summary of show
     * Obtener un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $whatsappChatId
     * @param string $id
     * @return WhatsappMessage|null
     */
    public static function show(
        string $companyId, 
        string $whatsappChatId, 
        string $id
    ): WhatsappMessage|null
    {
        return ShowWhatsappMessageService::show($companyId, $whatsappChatId, $id);
    }

     /**
     * Summary of store
     * Almacenar un nuevo mensaje de whatsapp en un chat específico para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $whatsappChatId
     * @return WhatsappMessage|null
    */
    public static function store(
        Request $request, 
        string $companyId, 
        string $whatsappChatId
    ): WhatsappMessage|null
    {
        return StoreWhatsappMessageService::store($request, $companyId, $whatsappChatId);
    }

    /**
    * Summary of update
    * Actualizar un mensaje de whatsapp específico de un chat para una empresa dada.
    * 
    * @param Request $request
    * @param string $companyId
    * @param string $whatsappChatId
    * @param string $id
    * @return bool|int
    */
    public static function update(
        Request $request, 
        string $companyId, 
        string $whatsappChatId, 
        string $id
    ): bool|int
    {
        return UpdateWhatsappMessageService::update($request, $companyId, $whatsappChatId, $id);
    }

     /**
     * Summary of destroy
     * Eliminar un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $whatsappChatId
     * @param string $id
     * @return void
     */
    public static function delete(
        string $companyId, 
        string $whatsappChatId, 
        string $id
    ): void
    {
        WhatsappMessageRepository::delete($companyId, $whatsappChatId, $id);
    }
}
