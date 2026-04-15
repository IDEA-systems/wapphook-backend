<?php

namespace App\Services\messenger;

use App\Services\logs\LogService;
use App\Support\ConstantSupport;
use GuzzleHttp\Client;


class SendWhatsappTextService
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
     * Enviar un mensaje de texto por WhatsApp utilizando la API de Facebook.
     * 
     * Cuando la app esta en prueba el numero de telefono no puede comenzar con el 521 en mexico
     * Por lo que para hacer las pruebas, procura que en la @param $data el parametro "to" 
     * tenga un numero de telefono solo con el 52 al inicio, ejemplo: 529971273591 en lugar de 5219371273591
     * 
     * @param string $api_key
     * @param string $phone_number_id
     * @param array $data
     * @return void
     */
    public static function send(
        string $api_key,
        string $phone_number_id, 
        array $data
    ): void
    {
        try {
            $API_URL = ConstantSupport::graphURL();
            $GRAPH_URL = "{$API_URL}/{$phone_number_id}/messages";
            
            $headers = [
                "Content-Type" => "application/json",
                "Authorization" => "Bearer {$api_key}"
            ];

            $fetch = new Client();
            
            $response = $fetch->post($GRAPH_URL, [
                "headers" => $headers,
                "json" => $data
            ]);

            $jsonResponse = $response->getBody()->getContents();
            LogService::output($jsonResponse);
        } catch (\Exception $error) {
            LogService::error($error->getMessage());
            throw new \Exception("Error al enviar el mensaje por WhatsApp");
        }
    }
}