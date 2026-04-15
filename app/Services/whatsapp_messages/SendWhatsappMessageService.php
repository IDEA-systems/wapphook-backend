<?php

namespace App\Services\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Models\WhatsappNumber;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;
use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;
use App\Services\messenger\SendWhatsappResponseService;
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
            $phone_number_id = $request->post('phone_number_id');
            $whatsappChatId = $request->post('whatsapp_chat_id');
            $messages = $request->post('messages');
            $status = $request->post('status');
            $badge = $request->post('badge');
            $type = $request->post('type');

            WhatsappMessageRepository::store([
                'company_id' => $companyId,
                'whatsapp_chat_id' => $whatsappChatId,
                'type' => $type,
                'badge' => $badge,
                'text' => $messages['text']['body'],
                'messages' => $messages,
                'status' => $status
            ]);

            $whatsapNumber = WhatsappNumberRepository::show($companyId, $phone_number_id);

            if (!$whatsapNumber) {
                throw new \Exception("El numero de whatsapp no existe", 400);
            }

            SendWhatsappResponseService::text(
                $whatsapNumber->id,
                $whatsapNumber->api_key,
                $messages
            );
        });
    }
}
