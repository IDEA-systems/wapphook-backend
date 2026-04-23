<?php

namespace App\Services\whatsapp_chats;

use App\Models\WhatsappChat;
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
     * @return WhatsappChat
     */
    public static function update(
        Request $request, 
        string $companyId, 
        string $id
    ): WhatsappChat
    {
        $whatsappChat = WhatsappChatRepository::show($companyId, $id);

        if (!$whatsappChat) {
            throw new \Exception("El chat seleccionado no existe", 400);
        }

        $whatsapp_number_id = $request->input('whatsapp_number_id', $whatsappChat->whatsapp_number_id);
        $from = $request->input('from', $whatsappChat->from);
        $contact_name = $request->input('contact_name', $whatsappChat->contact_name);
        $user_name = $request->input('user_name', $whatsappChat->user_name);
        $last_message = $request->input('last_message', $whatsappChat->last_message);
        $unread_messages = $request->input('unread_messages', $whatsappChat->unread_messages);
        $status = $request->input('status', $whatsappChat->status);

        return WhatsappChatRepository::update($companyId, $id, [
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
