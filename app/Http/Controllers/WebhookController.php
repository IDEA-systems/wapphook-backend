<?php

namespace App\Http\Controllers;

use App\Services\logs\LogService;
use App\Services\webhook\WebhookService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function __construct() 
    {}

    /**
     * Summary of suscribe
     * 
     * Lógica para suscribirse al webhook
     * 
     * @param Request $request
     * @param mixed $companyId
     * @return \Illuminate\Http\Response
     */
    public function suscribe(Request $request, $companyId)
    {
        try {

            $response = WebhookService::suscribe($request, $companyId);
            return response($response, 200);

        } catch (\Exception $error) {
            
            $message = $error->getMessage();
            LogService::error("WebhookController@suscribe: {$message}");

            return response([
                "name" => "WebhookSuscribeError",
                "message" => "Error al suscribir al webhook",
            ], 403);
            
        }
    }

    /**
     * Summary of receive
     * 
     * Lógica para recibir y procesar los datos del webhook
     * 
     * @param Request $request
     * @param mixed $companyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function receive(Request $request, $companyId)
    {
        try {

            $response = WebhookService::receive($request, $companyId);
            return response()->json($response, 200);

        } catch (\Exception $error) {

            $message = $error->getMessage();
            LogService::error("WebhookController@receive: {$message}");
            
            return response()->json([
                "name" => "WebhookReceiveError",
                "message" => "Error al procesar el webhook",
            ], 500);

        }
    }
}
