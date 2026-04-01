<?php

namespace App\Services\messenger;

use App\Services\whatsapp_responses\WhatsappResponseService;
use App\Services\logs\LogService;
use App\Support\ConstantSupport;
use GuzzleHttp\Client;

class SendWhatsappDefaultService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // Solo usar en ambitos de pruebas, para formatear el numero de telefono y evitar errores al enviar mensajes.
    public static function formatPhoneNumber(string $phoneNumber): string
    {
        // Eliminar cualquier caracter que no sea un numero
        $formattedNumber = preg_replace('/\D/', '', $phoneNumber);

        // Asegurarse de que el numero comience con 52
        if (str_starts_with($formattedNumber, '521')) {
            $formattedNumber = '52' . substr($formattedNumber, 3);
        }

        return $formattedNumber;
    }

    /**
     * Summary of send
     * 
     * Enviar un mensaje por WhatsApp utilizando la API de Facebook Graph
     * 
     * @param string $from
     * @param string $api_key
     * @param string $company_id
     * @param string $phone_number_id
     * @throws \Exception
     * @return void
     */
    public static function send(
        string $from, 
        string $api_key,
        string $phone_number_id,
        string $body
    ) {
        try {
            $API_URL = ConstantSupport::graphURL();

            $PHONE = $from; //self::formatPhoneNumber($from);

            $GRAPH_URL = "{$API_URL}/{$phone_number_id}/messages";
            
            $headers = [
                "Content-Type" => "application/json",
                "Authorization" => "Bearer {$api_key}"
            ];

            $data = [
                "messaging_product" => "whatsapp",
                "to" => $PHONE,
                "type" => "text",
                "text" => [
                    "body" => $body
                ]
            ];

            $fetch = new Client();
            
            $response = $fetch->post($GRAPH_URL, [
                "headers" => $headers,
                "json" => $data
            ]);

            $jsonResponse = $response->getBody()->getContents();

            // // Log del mensaje de respuesta enviado
            LogService::output($jsonResponse);
        } catch (\Exception $error) {
            LogService::error($error->getMessage());
            throw new \Exception("Error al enviar el mensaje por WhatsApp");
        }
    }
}
