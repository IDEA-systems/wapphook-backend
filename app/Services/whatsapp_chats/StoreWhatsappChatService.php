<?php

namespace App\Services\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use Illuminate\Http\Request;

class StoreWhatsappChatService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of store
     * Crear un nuevo chat de WhatsApp.
     * 
     * @param Request $request
     * @param string $companyId
     * @return WhatsappChat
     */
    public static function input(
        Request $request, 
        string $companyId
    ): WhatsappChat
    {
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $contacts = $value["contacts"][0];
        $phone_number_id = $value["metadata"]["phone_number_id"];
        $message = $value["messages"][0];
        $from = $message["from"];
        $user_name = $contacts["profile"]["name"];
        $id = "CHAT-{$from}";

        $chatData = [
            "id" => $id,
            "whatsapp_number_id" => $phone_number_id,
            "company_id" => $companyId,
            "from" => $from,
            "user_name" => $user_name,
            "status" => "active"
        ];

        // Si el chat ya existe, actualizar su información
        $whatsappChat = WhatsappChatRepository::show($companyId, $id);

        if ($whatsappChat) {
            return $whatsappChat;
        }

        return WhatsappChatRepository::store($chatData);
    }

    /**
     * Summary of output
     * Crear un nuevo chat de WhatsApp a partir de una salida de mensaje.
     * Se crea a partir de un nuevo mensaje de salida para un cliente especifico el cual
     * aun no tiene un chat creado, en el sistema de mensajes
     * 
     * @param Request $request
     * @param string $companyId
     * @return WhatsappChat
     */
    public static function output(
        Request $request, 
        string $companyId
    ): WhatsappChat
    {
        $phone_number_id = $request->post('phone_number_id');
        $messages = $request->post('messages');
        $id = "CHAT-{$messages['to']}";

        $chatData = [
            "id" => $id,
            "whatsapp_number_id" => $phone_number_id,
            "company_id" => $companyId,
            "from" => $messages['to'],
            "user_name" => null,
            "status" => "active"
        ];

        // Si el chat ya existe, actualizar su información
        $whatsappChat = WhatsappChatRepository::show($companyId, $id);

        if ($whatsappChat) {
            return $whatsappChat;
        }

        return WhatsappChatRepository::store($chatData);
    }
}
