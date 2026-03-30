<?php

namespace App\Services\webhook;

use App\Models\InputData;
use App\Services\logs\LogService;
use App\Services\messenger\SendWhatsapp;
use App\Services\whatsapp_numbers\WhatsappNumberService;
use Illuminate\Http\Request;

class WebhookService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function suscribe(Request $request, string $company_id)
    {
        $mode = $request->query('hub_mode');
        $challenge = $request->query('hub_challenge');

        if (!$challenge || !$mode) {
            throw new \Exception("Error al suscribir el webhook", 400);
        }

        if ($mode !== 'subscribe') {
            throw new \Exception("Error al suscribir el webhook", 400);
        }

        return $challenge;
    }

    public static function receive(Request $request, string $company_id)
    {
        /**
         * Estos son los eventos que se disparan cuando se recibe un mensaje, 
         * o se responde a un mensaje, etc por parte del cliente que 
         * envió el mensaje 
        */
        $entryMessages = isset($request->entry[0]["changes"][0]["value"]["messages"][0]);

        /**
         *  Estos eventos se disparan cuando se responde a un mensaje, 
         * o se entrega un mensaje, etc por parte de la cuenta de whatsapp, 
         * no por parte del cliente que envió el mensaje 
        */
        $statusesResponse = isset($request->entry[0]["changes"][0]["value"]["statuses"][0]);

        if ($entryMessages) {
            return WebhookEntries::process($request, $company_id);
        }

        if ($statusesResponse) {
            $response =json_encode($request->entry[0]);
            LogService::whatsappStatuses($response);
            // TODO: Save messages in database
        }
    }
}
