<?php

namespace App\Services\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Models\WhatsappNumber;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;
use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;
use App\Services\logs\LogService;
use App\Services\messenger\SendWhatsappResponseService;
use App\Support\ConstantSupport;
use Illuminate\Http\Request;

class SendWhatsappMessageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of send
     * Enviar un mensaje de whatsapp a un chat específico para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @return void
     */
    public static function send(
        Request $request,
        string $companyId
    ): void
    {
        \DB::transaction(function () use ($request, $companyId) {
            $modeMessage = ConstantSupport::badgeOutput();

            $whatsapp_chat_id = $request->post('whatsapp_chat_id');
            $phone_number_id = $request->post('phone_number_id');
            $messages = $request->post('messages');

            $whatsapNumberData = WhatsappNumberRepository::show($companyId, $phone_number_id);

            if (!$whatsapNumberData) {
                throw new \Exception("El numero de whatsapp no existe", 400);
            }

            $whatsappNumberId = $whatsapNumberData->id;
            $apiKey = $whatsapNumberData->api_key;

            WhatsappMessageService::store($request, $companyId, $whatsapp_chat_id, $modeMessage);
            SendWhatsappResponseService::text($whatsappNumberId, $apiKey, $messages);
        });
    }
}
