<?php

namespace App\Services\webhook;

use App\Support\ConstantSupport;
use Illuminate\Http\Request;
use App\Services\logs\LogService;
use App\Services\whatsapp_chats\WhatsappChatService;
use App\Services\whatsapp_messages\WhatsappMessageService;

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
            $modeMessage = ConstantSupport::badgeInput();
            
            $whatsappChatData = WhatsappChatService::store($request, $companyId, $modeMessage);

            $whatsappchatId = $whatsappChatData->id;

            $whatsappMessageData = WhatsappMessageService::store($request, $companyId, $whatsappchatId, $modeMessage);

            LogService::entries(json_encode($whatsappMessageData));
        });
    }
}