<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use Illuminate\Pagination\LengthAwarePaginator;

class WhatsappChatRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of last
     * 
     * Obtiene el último mensaje de whatsapp de un chat específico.
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return WhatsappMessage|null
     */
    public static function last(string $companyId, string $id): WhatsappMessage|null
    {
        return LastMessageWhatsappChatRepository::last($companyId, $id);
    }

    /**
    * Summary of count
    * 
    * Cuenta el número de mensajes de whatsapp para un chat específico, con filtros opcionales.
    * 
    * @param string $companyId
    * @param string $id
    * @param array $filters
    * @throws \Exception
    * @return int
    */
    public static function count(
        string $companyId, 
        string $id, 
        array $filters = []
    ): int
    {
        return CountWhatsappChatMessagesRepository::count($companyId, $id, $filters);
    }

    /**
     * Summary of messages
     * 
     * Obtiene una lista paginada de mensajes de whatsapp para un chat específico, con filtros opcionales.
     * 
     * @param string $companyId
     * @param string $id
     * @param array $filters
     * @param array $pagination
     * @throws \Exception
     * @return LengthAwarePaginator
     */
    public static function messages(
        string $companyId, 
        string $id, 
        array $filters = [], 
        array $pagination = []
    ) : LengthAwarePaginator
    {
        return IndexWhatsappMessageRepository::messages($companyId, $id, $filters, $pagination);
    }

    /**
     * Summary of index
     * 
     * Obtiene una lista paginada de chats de whatsapp para una empresa dada, con filtros opcionales.
     * 
     * @param string $companyId
     * @param array $filters
     * @param array $pagination
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public static function index(
        string $companyId, 
        array $filters = [], 
        array $pagination = []
    ): LengthAwarePaginator
    {
        return IndexWhatsappChatRepository::index($companyId, $filters, $pagination);
    }
    
    /**
     * Summary of show
     * 
     * Obtiene un chat de whatsapp específico para una empresa dada.
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return WhatsappChat|null
     */
    public static function show(
        string $companyId, 
        string $id
    ): WhatsappChat|null
    {
        return ShowWhatsappChatRepository::show($companyId, $id);
    }

    /**
     * Summary of store
     * 
     * Crea un nuevo chat de whatsapp con los datos proporcionados.
     * Las validaciones y el manejo de errores se realizan en la capa de servicio.
     * 
     * @param array $data
     * @throws \Exception
     * @return WhatsappChat
     */
    public static function store(array $data): WhatsappChat
    {
        return StoreWhatsappChatRepository::store($data);
    }

    /**
     * Summary of update
     * 
     * Actualiza un chat de whatsapp existente con los datos proporcionados.
     * Las validaciones y el manejo de errores se realizan en la capa de servicio.
     * 
     * @param string $companyId company_id para asegurar que el chat pertenece a la empresa
     * @param string $id ID del chat de whatsapp a actualizar
     * @param array $data Datos a actualizar en el chat de whatsapp
     * @throws \Exception
     * @return void
     */
    public static function update(
        string $companyId, 
        string $id, 
        array $data
    ): void
    {
        UpdateWhatsappChatRepository::update($companyId, $id, $data);
    }

    /**
     * Summary of read
     * 
     * Marcar mensajes como leídos en un chat de WhatsApp específico.
     * Las validaciones y el manejo de errores se realizan en la capa de servicio.
     * 
     * @param string $companyId company_id para asegurar que los mensajes pertenecen a la empresa
     * @param string $id ID del chat de whatsapp cuyos mensajes se marcarán como leídos
     * @throws \Exception
     * @return void
     */
    public static function mark(
        string $companyId, 
        string $id,
        array $data
    ): void
    {
        MarkWhatsappChatRepository::mark($companyId, $id, $data);
    }

    /**
     * Summary of delete
     * 
     * Elimina un chat de whatsapp específico para una empresa dada.
     * Las validaciones y el manejo de errores se realizan en la capa de servicio.
     * 
     * @param string $companyId company_id para asegurar que el chat pertenece a la empresa
     * @param string $id ID del chat de whatsapp a eliminar
     * @throws \Exception
     * @return void
     */
    public static function delete(
        string $companyId, 
        string $id
    ): void
    {
        DeleteWhatsappChatRepository::delete($companyId, $id);
    }
}