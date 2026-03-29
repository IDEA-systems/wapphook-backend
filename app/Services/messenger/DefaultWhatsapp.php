<?php

namespace App\Services\messenger;

use App\Support\Constants;
use App\Support\DefaultMessages;
use GuzzleHttp\Client;

class DefaultWhatsapp
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function send(string $url, string $from, string $api_key, string $type = "not_available") 
    {
        try {

            $body = "";

            if ($type == "not_available") {
                $body = DefaultMessages::notAvailable();
            }

            $clientHTTP = new Client();

            $response = $clientHTTP->post($url, [
                "headers" => [
                    "Content-Type" => "application/json",
                    "Authorization" => "Bearer {$api_key}"
                ],
                "json" => [
                    "messaging_product" => "whatsapp",
                    "to" => $from,
                    "type" => "text",
                    "text" => [
                        "body" => $body
                    ]
                ]
            ]);

            return $response;
        } catch (\Exception $error) {
            \Log::channel('error')->error($error->getMessage());
            throw new \Exception("Error al enviar el mensaje por WhatsApp");
        }
    }
}
