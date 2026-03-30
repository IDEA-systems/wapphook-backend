<?php

namespace App\Services\webhook;

use App\Services\logs\LogService;
use App\Services\messenger\SendWhatsapp;
use App\Services\whatsapp_numbers\WhatsappNumberService;
use Illuminate\Http\Request;

class WebhookEntries
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function process(Request $request, string $company_id)
    {
        $entry = $request->entry[0];

        if (!$entry) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $changes = $entry["changes"][0];
        
        if (!$changes) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $value = $changes["value"];

        if (!$value) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $metadata = $value["metadata"];

        if (!$metadata) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $contacts = $value["contacts"][0];

        if (!$contacts) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $messages = $value["messages"][0];

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
        $phone_number_id = $metadata["phone_number_id"];
        
        $whatsappNumber = WhatsappNumberService::show($phone_number_id, $company_id);

        if (!$whatsappNumber) {
            throw new \Exception("Error al obtener el numero de whatsapp", 500);
        }

        $from = $messages["from"];
        
        if (!$from) {
            throw new \Exception("Error al recibir el webhook", 400);
        }

        $type = "not_available";

        $api_key = $whatsappNumber->api_key;

        // Mensaje entrante recibido
        $data = json_encode($entry);
        
        LogService::whatsappEntries($data);

        // Enviar un mensaje al numero de teléfono que envió el mensaje
        // Utilizando la API de WhatsApp Business
        // Con una respues predefinida, en la configuracion
        return SendWhatsapp::default($from, $phone_number_id, $api_key, $type);
    }
}