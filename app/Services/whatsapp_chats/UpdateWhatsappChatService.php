<?php

namespace App\Services\whatsapp_chats;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use Illuminate\Http\Request;

class UpdateWhatsappChatService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of the update function.
     * Actualiza un chat de WhatsApp existente con los datos proporcionados en la solicitud.
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
        $whatsappChat = WhatsappChatRepository::show($companyId, $id);

        if (!$whatsappChat) {
            throw new \Exception("El chat seleccionado no existe", 400);
        }

        $whatsapp_number_id = isset($request->whatsapp_number_id) 
            ? $request->whatsapp_number_id 
            : $whatsappChat->whatsapp_number_id;

        $from = isset($request->from) 
            ? $request->from 
            : $whatsappChat->from;

        $contact_name = isset($request->contact_name) 
            ? $request->contact_name 
            : $whatsappChat->contact_name;

        $user_name = isset($request->user_name) 
            ? $request->user_name 
            : $whatsappChat->user_name;

        $last_message = isset($request->last_message) 
            ? $request->last_message 
            : $whatsappChat->last_message;

        $unread_messages = isset($request->unread_messages) 
            ? $request->unread_messages 
            : $whatsappChat->unread_messages;

        $status = isset($request->status) 
            ? $request->status 
            : $whatsappChat->status;

        WhatsappChatRepository::update($companyId, $id, [
            'whatsapp_number_id' => $whatsapp_number_id,
            'from' => $from,
            'contact_name' => $contact_name,
            'user_name' => $user_name,
            'last_message' => $last_message,
            'unread_messages' => $unread_messages,
            'status' => $status,
        ]);
    }
}
