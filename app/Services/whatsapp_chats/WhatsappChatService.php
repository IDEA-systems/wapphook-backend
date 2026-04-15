<?php

namespace App\Services\whatsapp_chats;

use Illuminate\Http\Request;
use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use Illuminate\Pagination\LengthAwarePaginator;

class WhatsappChatService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of count
     * Contar el número total de mensajes en un chat de WhatsApp específico con filtros aplicados.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $id
     * @return int
     */
    public static function count(
        Request $request, 
        string $companyId, 
        string $id
    ): int
    {
        return CountWhatsappMessageService::count($request, $companyId, $id);
    }

    /**
     * Summary of last
     * Obtener el último mensaje de un chat de WhatsApp específico.
     * 
     * @param string $companyId
     * @param string $id
     * @return WhatsappMessage|null
    */
    public static function last(
        string $companyId, 
        string $id
    ): WhatsappMessage|null
    {
        return LastWhatsappMessageService::last($companyId, $id);
    }

    /**
     * Summary of messages
     * Obtener los mensajes de un chat de WhatsApp específico con filtros y paginación.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $id
     * @return LengthAwarePaginator
     */
    public static function messages(
        Request $request, 
        string $companyId, 
        string $id
    ): LengthAwarePaginator
    {
        return IndexWhatsappChatMessagesService::messages($request, $companyId, $id);
    }

    /**
     * Summary of index
     * Obtener una lista de chats de WhatsApp con paginación, filtrado y ordenamiento.
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
        return IndexWhatsappChatService::index($request, $companyId);
    }

    /**
     * Summary of show
     * Obtener los detalles de un chat de WhatsApp específico por su ID.
     * 
     * @param string $companyId
     * @param string $id
     * @return WhatsappChat
     */
    public static function show(
        string $companyId, 
        string $id
    ): WhatsappChat
    {
        return ShowWhatsappChatService::show($companyId, $id);
    }

    /**
     * Summary of store
     * Crear un nuevo chat de WhatsApp.
     * 
     * @param Request $request
     * @param string $companyId
     * @return WhatsappChat
     */
    public static function store(
        Request $request, 
        string $companyId
    ): WhatsappChat
    {
        return StoreWhatsappChatService::store($request, $companyId);
    }

    /**
     * Summary of update
     * Actualizar un chat de WhatsApp existente.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $id
     * @return void
     */
    public static function update(
        Request $request, 
        string $companyId, 
        string $id
    ): void
    {
        UpdateWhatsappChatService::update($request, $companyId, $id);
    }

    /**
     * Summary of delete
     * Eliminar un chat de WhatsApp existente.
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
        DeleteWhatsappChatService::delete($companyId, $id);
    }
}
