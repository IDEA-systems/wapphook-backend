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
     * @param mixed $company_id
     * @return \Illuminate\Http\Response
     */
    public function suscribe(Request $request, $company_id)
    {
        try {
            $response = WebhookService::suscribe($request, $company_id);
            return response($response, 200);
        } catch (\Exception $th) {
            return response("", 403);
        }
    }

    /**
     * Summary of receive
     * 
     * Lógica para recibir y procesar los datos del webhook
     * 
     * @param Request $request
     * @param mixed $company_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function receive(Request $request, $company_id)
    {
        try {
            $response = WebhookService::receive($request, $company_id);
            return response()->json($response, 200);
        } catch (\Exception $error) {
            LogService::error($error->getMessage());
            return response()->json([], 500);
        }
    }
}
