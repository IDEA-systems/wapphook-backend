<?php

namespace App\Services\webhook;

use App\Services\logs\LogService;
use App\Services\verify_tokens\VerifytokenService;
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

    /**
     * Summary of suscribe
     * 
     * Suscribir el webhook de Facebook Graph
     * Validar el token de suscripción y el challenge
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $companyId
     * @return mixed
     */
    public static function suscribe(Request $request, string $companyId)
    {

        $mode = $request->query('hub_mode');
        $challenge = $request->query('hub_challenge');
        $verify_token = $request->query('hub_verify_token');

        if (!$challenge || !$mode || !$verify_token) {
            throw new \Exception("Datos de suscripción incompletos", 400);
        }

        if ($mode !== 'subscribe') {
            throw new \Exception("Modo de suscripción incorrecto", 400);
        }

        $webhookToken = VerifytokenService::show($companyId, $verify_token);
        
        if (!$webhookToken) {
            throw new \Exception("Token de verificacion incorrecto", 400);
        }

        return $challenge;
    }

    /**
     * Summary of receive
     * 
     * Recibir la entrada del webhook de Facebook Graph
     * Procesar la entrada y almacenar el mensaje en la base de datos
     * Enviar una respuesta por defecto al cliente.
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $companyId
     * @return mixed
     */
    public static function receive(Request $request, string $companyId)
    {
        // Estos son los eventos que se disparan cuando se recibe un mensaje
        $entryMessages = isset($request->entry[0]["changes"][0]["value"]["messages"][0]);

        // Estos eventos se disparan cuando se responde a un mensaje
        $statusesResponse = isset($request->entry[0]["changes"][0]["value"]["statuses"][0]);

        if (!$entryMessages && !$statusesResponse) {
            throw new \Exception("Error al procesar el webhook", 400);
        }

        if ($entryMessages) {
            return WebhookEntrieService::process($request, $companyId);
        }

        if ($statusesResponse) {
            $response =json_encode($request->entry[0]);
            LogService::statuses($response);
            return $response;
            // TODO: Save messages in database
        } 
    }
}
