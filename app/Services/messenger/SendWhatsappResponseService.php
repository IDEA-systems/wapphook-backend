<?php

namespace App\Services\messenger;

use App\Services\whatsapp_responses\WhatsappResponseService;

class SendWhatsappResponseService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of default
     * 
     * Enviar una respuesta por defecto
     * Para que el cliente sepa que su mensaje ha sido recibido
     * 
     * Este mesaje es el que esta marcado con default=true en la tabla
     * whatsapp_responses de la base de datos, y cada compañia debe tener
     * Un mensaje configurado como default
     * 
     * @param mixed $to
     * @param mixed $phone_number_id
     * @param mixed $api_key
     * @param mixed $companyId
     * @return void
     */
    public static function default($to, $phone_number_id, $api_key, $companyId): void
    {
        $defaultResponse = WhatsappResponseService::default($companyId);

        if ($defaultResponse) {
            $body = $defaultResponse->message;
            SendWhatsappDefaultService::send($to, $api_key, $phone_number_id, $body);
        }
    }

    /**
     * Summary of text
     * 
     * Enviar una respuesta de texto
     * 
     * @param mixed $phone_number_id
     * @param mixed $api_key
     * @param mixed $data
     * @return void
     */
    public static function text(
        string $phone_number_id, 
        string $api_key, 
        array $data
    ): void
    {
        SendWhatsappTextService::send($api_key, $phone_number_id, $data);
    }

    public static function template($from, $phone_number_id, $api_key, $companyId): void
    {
        // Este metodo se puede usar para enviar un mensaje con plantilla, utilizando la API de Facebook Graph.
    }
}
