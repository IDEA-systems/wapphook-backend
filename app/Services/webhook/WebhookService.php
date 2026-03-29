<?php

namespace App\Services\webhook;

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
        $entry = $request->entry[0] ?? null;
        
        if (!$entry) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $changes = $entry["changes"][0] ?? null;
        
        if (!$changes) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $value = $changes["value"] ?? null;

        if (!$value) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $metadata = $value["metadata"] ?? null;

        if (!$metadata) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $contacts = $value["contacts"][0] ?? null;

        if (!$contacts) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $messages = $value["messages"][0] ?? null;

        if (!$messages) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        /**
         * @var mixed
         * 
         * Datos que identifican a la empresa que recibe los mensajes
         * Con estos datos se sabe a que numero de whatsapp se envio este mensaje
         * Util si se tiene mas de un numero de whatsapp en la cuenta de whatsapp
         */
        $displayPhoneNumber = $metadata["display_phone_number"] ?? null; 
        $phone_number_id = $metadata["phone_number_id"] ?? null;
        
        $whatsappNumber = WhatsappNumberService::show($phone_number_id, $company_id);

        if (!$whatsappNumber) {
            throw new \Exception("Error al obtener el numero de whatsapp", 500);
        }

        // Enviar un mensaje al numero de teléfono que envió el mensaje
        // Utilizando la API de WhatsApp Business
        // Con una respues predefinida, en la configuracion
        $from = $messages["from"] ?? null;
        
        if (!$from) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $type = "not_available";
        $api_key = $whatsappNumber->api_key;

        $message = SendWhatsapp::default($from, $phone_number_id, $api_key, $type);

        return $message;
    }
}
