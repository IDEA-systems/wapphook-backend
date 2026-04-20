<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Services\logs\LogService;
use App\Services\whatsapp_messages\WhatsappMessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhatsappMessageController extends Controller
{
    /**
     * Summary of index
     * Obtener los mensajes de whatsapp de un chat y una compañía, con filtros y paginación.
     * 
     * @param PaginationRequest $request
     * @param string $companyId
     * @return JsonResponse
     */
    public static function index(
        PaginationRequest $request, 
        string $companyId
    ): JsonResponse
    {
        try {
            $response = WhatsappMessageService::index($request, $companyId);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Lista de mensajes de whatsapp',
                'data' => $response
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WhatsappMessageController@index: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Whatsapp messages',
                'message' => $message
            ], $code);
        }
    }

    /**
     * Summary of show
     * Obtener un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $id
     * @return JsonResponse
     */
    public static function show(
        Request $request, 
        string $companyId,
        string $id
    ): JsonResponse
    {
        try {
            $response = WhatsappMessageService::show($companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Detalle de mensaje de whatsapp',
                'data' => $response
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WhatsappMessageController@show: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Whatsapp message',
                'message' => $message
            ], $code);
        }
    }

    /**
     * Summary of send
     * Enviar un mensaje de whatsapp a un chat específico para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @return JsonResponse
     */
    public static function send(
        Request $request, 
        string $companyId
    ): JsonResponse
    {
        try {
            WhatsappMessageService::send($request, $companyId);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Mensaje de whatsapp creado'
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WhatsappMessageController@send: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Whatsapp message',
                'message' => $message
            ], $code);
        }
    }

    /**
     * Summary of update
     * Actualizar un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $id
     * @return JsonResponse
     */
    public static function update(
        Request $request, 
        string $companyId,
        string $id
    ): JsonResponse
    {
        try {
            WhatsappMessageService::update($request, $companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Mensaje de whatsapp actualizado'
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WhatsappMessageController@update: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Whatsapp message',
                'message' => $message
            ], $code);
        }
    }

    /**
     * Summary of delete
     * Eliminar un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $id
     * @return JsonResponse
     */
    public static function delete(
        Request $request, 
        string $companyId,
        string $id
    ): JsonResponse
    {
        try {
            WhatsappMessageService::delete($companyId, $id);

            return response()->json([
                'status' => 204,
                'title' => 'Completado',
                'details' => 'Mensaje de whatsapp eliminado'
            ], 204);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WhatsappMessageController@delete: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Whatsapp message',
                'message' => $message
            ], $code);
        }
    }
}
