<?php

namespace App\Http\Controllers;

use App\Services\logs\LogService;
use App\Services\webhook\WebhookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param string $companyId
     * @return Response
     */
    public function suscribe(Request $request, string $companyId): Response
    {
        try {
            $response = WebhookService::suscribe($request, $companyId);
            $headers = ['Content-Type' => 'text/plain'];
            return response($response, 200, $headers);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 403;
            $message = $error->getMessage();
            $headers = ['Content-Type' => 'text/plain'];
            LogService::error("WebhookController@suscribe: $message");
            
            return response($message, $code, $headers);
        }
    }

    /**
     * Summary of receive
     * 
     * Lógica para recibir y procesar los datos del webhook
     * 
     * @param Request $request
     * @param string $companyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function receive(Request $request, string $companyId): JsonResponse
    {
        try {
            $response = WebhookService::receive($request, $companyId);
            return response()->json($response, 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WebhookController@receive: {$message}");
            
            return response()->json([
                "name" => "Webhook",
                "message" => "Error al procesar el webhook",
            ], $code);
        }
    }
}
