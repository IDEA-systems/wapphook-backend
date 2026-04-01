<?php

namespace App\Services\webhook;

use App\Services\logs\LogService;
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
        // Estos son los eventos que se disparan cuando se recibe un mensaje
        $entryMessages = isset($request->entry[0]["changes"][0]["value"]["messages"][0]);

        // Estos eventos se disparan cuando se responde a un mensaje
        $statusesResponse = isset($request->entry[0]["changes"][0]["value"]["statuses"][0]);

        if (!$entryMessages && !$statusesResponse) {
            throw new \Exception("Error al procesar el webhook", 400);
        }

        if ($entryMessages) {
            WebhookEntrieService::process($request, $company_id);
        }

        if ($statusesResponse) {
            $response =json_encode($request->entry[0]);
            LogService::statuses($response);
            // TODO: Save messages in database
        } 
    }
}
