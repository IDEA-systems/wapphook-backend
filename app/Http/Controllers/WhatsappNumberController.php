<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\WhatsappNumberStoreRequest;
use App\Http\Requests\WhatsappNumberUpdateRequest;
use App\Services\whatsapp_numbers\WhatsappNumberService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\logs\LogService;

class WhatsappNumberController extends Controller
{
    /**
     * Summary of index
     * Obtener los numeros de telefono de cuentas de whatsapp de una empresa
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
            $response = WhatsappNumberService::index($request, $companyId);

            return response()->json([
                "status" => 200,
                "title" => "Completado",
                "details" => "Numeros de whatsapp obtenidos correctamente",
                "data" => $response
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappNumberController@index: $message");

            return response()->json([
                "status" => $code,
                "name" => "Whatsapp numbers",
                "message" => $message
            ], $code);
        }
    }

    /**
     * Summary of show
     * Obtener un numero de telefono de cuenta de whatsapp de una empresa
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
            $response = WhatsappNumberService::show($companyId, $id);

            return response()->json([
                "status" => 200,
                "title" => "Completado",
                "details" => "Número de whatsapp obtenido correctamente",
                "data" => $response
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappNumberController@show: $message");

            return response()->json([
                "status" => $code,
                "name" => "Whatsapp numbers",
                "message" => $message
            ], $code);
        }
    }

    /**
    * Summary of store
    * Crear un nuevo numero de telefono de cuenta de whatsapp para una empresa
    * 
    * @param WhatsappNumberStoreRequest $request
    * @param string $companyId
    * @return JsonResponse
    */
    public static function store(
        WhatsappNumberStoreRequest $request, 
        string $companyId
    ): JsonResponse
    {
        try {
            $response = WhatsappNumberService::store($request, $companyId);

            return response()->json([
                "status" => 201,
                "title" => "Completado",
                "details" => "Número de whatsapp creado correctamente",
                "data" => $response
            ], 201);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappNumberController@store: $message");

            return response()->json([
                "status" => $code,
                "name" => "Whatsapp numbers",
                "message" => $message
            ], $code);
        }
    }

    public static function update(
        WhatsappNumberUpdateRequest $request, 
        string $companyId, 
        string $id
    ): JsonResponse
    {
        try {
            $response = WhatsappNumberService::update($request, $companyId, $id);

            return response()->json([
                "status" => 200,
                "title" => "Completado",
                "details" => "Número de whatsapp actualizado correctamente"
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappNumberController@update: $message");

            return response()->json([
                "status" => $code,
                "name" => "Whatsapp numbers",
                "message" => $message
            ], $code);
        }
    }

    /**
    * Summary of delete
    * Eliminar un numero de telefono de cuenta de whatsapp de una empresa
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
            WhatsappNumberService::delete($companyId, $id);

            return response()->json([
                "status" => 200,
                "title" => "Completado",
                "details" => "Número de whatsapp eliminado correctamente"
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappNumberController@delete: $message");

            return response()->json([
                "status" => $code,
                "name" => "Whatsapp numbers",
                "message" => $message
            ], $code);
        }
    }
}
