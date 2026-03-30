<?php

namespace App\Services\messenger;

use App\Services\logs\LogService;
use App\Support\Constants;
use App\Support\DefaultMessages;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

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

            $headers = [
                "Content-Type" => "application/json",
                "Authorization" => "Bearer {$api_key}"
            ];

            $data = [
                "messaging_product" => "whatsapp",
                "to" => $from,
                "type" => "text",
                "text" => [
                    "body" => $body
                ]
            ];

            $response = Http::withHeaders($headers)->post($url, $data);
            $content = $response->getBody()->getContents();

            // Log del mensaje de respuesta enviado
            LogService::whatsappOutput($content);

            return $response;
        } catch (\Exception $error) {
            LogService::error($error->getMessage());
            throw new \Exception("Error al enviar el mensaje por WhatsApp");
        }
    }
}
