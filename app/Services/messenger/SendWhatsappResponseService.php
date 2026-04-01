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
     * @param mixed $from
     * @param mixed $phone_number_id
     * @param mixed $api_key
     * @param mixed $company_id
     * @return void
     */
    public static function default($from, $phone_number_id, $api_key, $company_id)
    {
        $defaultResponse = WhatsappResponseService::default($company_id);

        if ($defaultResponse) {
            $body = $defaultResponse->message;

            SendWhatsappDefaultService::send($from, $api_key, $phone_number_id, $body);
        }
    }

    public static function text($from, $phone_number_id, $api_key, $company_id)
    {
        // Este metodo se puede usar para enviar un mensaje de texto personalizado, sin necesidad de tenerlo configurado como default en la base de datos.
    }

    public static function template($from, $phone_number_id, $api_key, $company_id)
    {
        // Este metodo se puede usar para enviar un mensaje con plantilla, utilizando la API de Facebook Graph.
    }
}
