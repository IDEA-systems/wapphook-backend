<?php

namespace App\Services\webhook;

use App\Services\logs\LogService;
use App\Services\whatsapp_messages\WhatsappMessageService;
use App\Services\whatsapp_numbers\WhatsappNumberService;
use App\Services\whatsapp_chats\WhatsappChatService;
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
     * @param string $companyId
     * @return void
     */
    public static function process(Request $request, string $companyId): void
    {
        \DB::transaction(function () use ($request, $companyId) {
            $entry = $request->entry[0];
            $changes = $entry["changes"][0];
            $value = $changes["value"];
            $metadata = $value["metadata"];
            $messages = $value["messages"][0];
            $phone_number_id = $metadata["phone_number_id"];
            $from = $messages["from"];

            $whatsappNumber = WhatsappNumberService::show($companyId, $phone_number_id);
            $phone_number_id = $whatsappNumber->id;
            $api_key = $whatsappNumber->api_key;

            $chatData = WhatsappChatService::store($request, $companyId);
            
            WhatsappMessageService::store($request, $companyId);
            LogService::entries(json_encode($entry));
        });
    }
}