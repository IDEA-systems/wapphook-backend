<?php

namespace App\Services\webhook;

use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use App\Services\logs\LogService;
use App\Services\whatsapp_messages\WhatsappMessageService;
use App\Services\whatsapp_numbers\WhatsappNumberService;
use App\Services\whatsapp_chats\WhatsappChatService;
use App\Services\messenger\SendWhatsappResponseService;
use Illuminate\Http\Request;

class WebhookEntrieService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of process
     * 
     * Procesar la entrada del webhook de Facebook Graph
     * Almacenar el mensaje en la base de datos 
     * Enviar una respuesta por defecto al cliente.
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $company_id
     * @return void
     */
    public static function process(Request $request, string $company_id)
    {
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $metadata = $value["metadata"];
        $messages = $value["messages"][0];
        $phone_number_id = $metadata["phone_number_id"];
        $from = $messages["from"];
        $chatId = "CHAT-{$from}";

        $whatsappNumber = WhatsappNumberService::show($phone_number_id, $company_id);

        $api_key = $whatsappNumber->api_key;

        // El service lanza una exception si no encuentra el chatId
        // Se usa en repository en este caso para evitar cortar el proceso
        $chat = WhatsappChatRepository::show($chatId, $company_id);

        if (!$chat) {
            WhatsappChatService::store($request, $company_id);
            WhatsappMessageService::store($request, $company_id);
            SendWhatsappResponseService::default($from, $phone_number_id, $api_key, $company_id);
            LogService::entries(json_encode($entry));
        }

        WhatsappMessageService::store($request, $company_id);
        SendWhatsappResponseService::default($from, $phone_number_id, $api_key, $company_id);
        LogService::entries(json_encode($entry));
    }
}