<?php

namespace App\Repositories\whatsapp_messages;

use App\Models\WhatsappMessage;
use Illuminate\Pagination\LengthAwarePaginator;

class WhatsappMessageRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of show
     * Obtiene un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $whatsappChatId
     * @param array $filters
     * @param array $params
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function index(
        string $companyId, 
        string $whatsappChatId, 
        array $filters = [], 
        array $params = []
    ): LengthAwarePaginator
    {
        return IndexWhatsappMessageChatRepository::index($companyId, $whatsappChatId, $filters, $params);
    }

    /**
     * Summary of show
     * Obtiene un mensaje de whatsapp específico de un chat para una empresa dada.
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
        return ShowWhatsappMessageChatRepository::show($companyId, $whatsappChatId, $id);
    }

    /**
     * Summary of store
     * 
     * Crea un nuevo mensaje de whatsapp en un chat específico para una empresa dada.
     * 
     * @param array $data
     * @throws \Exception
     * @return WhatsappMessage|null
     */
    public static function store(array $data): WhatsappMessage
    {
        return StoreWhatsappMessageRepository::store($data);
    }

    /**
     * Summary of update
     * 
     * Actualiza un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $whatsappChatId
     * @param string $id
     * @param array $data
     * @throws \Exception
     * @return void
     */
    public static function update(string $companyId, string $whatsappChatId, string $id, array $data): bool|int
    {
        return UpdateWhatsappMessageChatRepository::update($companyId, $whatsappChatId, $id, $data);
    }

    /**
     * Summary of delete
     * 
     * Elimina un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $whatsappChatId
     * @param string $id
     * @throws \Exception
     * @return void
     */
    public static function delete(string $companyId, string $whatsappChatId, string $id): void
    {
        $whatsappMessage = ShowWhatsappMessageChatRepository::show($companyId, $whatsappChatId, $id);

        if (!$whatsappMessage) {
            throw new \Exception("El mensaje seleccionado no existe para la empresa y chat especificados.", 400);
        }

        DeleteWhatsappMessageChatRepository::delete($companyId, $whatsappChatId, $id);
    }
}
