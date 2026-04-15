<?php

namespace App\Http\Controllers;

use App\Services\logs\LogService;
use App\Services\whatsapp_chats\WhatsappChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhatsappChatController extends Controller
{
    /**
     * Summary of index
     * Obtener la lista de los chats de una empresa
     * 
     * @param Request $request
     * @param string $companyId
     * @return JsonResponse
     */
    public static function index(
        Request $request, 
        string $companyId
    ): JsonResponse
    {
        try {
            $response = WhatsappChatService::index($request, $companyId);

            return response()->json([
                'title' => 'Completado',
                'details' => 'Lista de chats de la compañía',
                'data' => $response
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WhatsappChatController@index: $message");

            return response()->json([
                'name' => 'Error interno',
                'message' => $message
            ], $code);
        }
    }

    /**
     * Summary of show
     * Obtener los detalles de un chat especifico
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
            $response = WhatsappChatService::show($companyId, $id);
            
            return response()->json([
                'title' => 'Completado',
                'details' => 'Detalles del mensaje',
                'data' => $response
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WhatsappChatController@show: $message");

            return response()->json([
                'name' => 'Error interno del servidor',
                'message' => $message
            ], $code);
        }
    }

    /**
     * Summary of messages
     * Obtener los mensajes de un chat especifico
     * 
     * @param Request $request
     * @param mixed $companyId
     * @param mixed $id
     * @return JsonResponse
     */
    public static function messages(Request $request, $companyId, $id): JsonResponse
    {
        try {
            $response = WhatsappChatService::messages($request, $companyId, $id);

            return response()->json([
                "title" => "Completado",
                "details" => "Lista de mensajes del chat",
                "data" => $response
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();

            return response()->json([
                "name" => "Error interno",
                "message" => $message
            ], $code);
        }
    }

    /**
     * Summary of update
     * Actualizar la informacion de un chat seleccionado
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
            WhatsappChatService::update($request, $companyId, $id);
            
            return response()->json([
                'title' => 'Completado',
                'details' => 'Chat actualizado correctamente',
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WhatsappChatController@update: $message");

            return response()->json([
                'name' => 'Error interno del servidor',
                'message' => $message
            ], $code);
        }
    }

    public static function delete(
        Request $request, 
        string $companyId, 
        string $id
    ): JsonResponse
    {
        try {
            WhatsappChatService::delete($companyId, $id);

            return response()->json([
                'title' => 'Completado',
                'details' => 'Chat eliminado exitosamente'
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("WhatsappChatController@delete: $message");

            return response()->json([
                'name' => 'Error interno del servidor',
                'message' => $message
            ], $code);
        }
    }
}
