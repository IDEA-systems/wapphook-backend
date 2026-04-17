<?php

namespace App\Http\Controllers;

use App\Http\Requests\WhatsappAccountIndexRequest;
use App\Http\Requests\WhatsappAccountStoreRequest;
use App\Http\Requests\WhatsappAccountUpdateRequest;
use App\Services\logs\LogService;
use App\Services\whatsapp_accounts\WhatsappAccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhatsappAccountController extends Controller
{
    /**
     * Summary of index
     * Obtener las cuentas de whatsapp de una empresa.
     * 
     * @param WhatsappAccountIndexRequest $request
     * @param string $companyId
     * @return JsonResponse
     */
    public static function index(
        WhatsappAccountIndexRequest $request,
        string $companyId
    ): JsonResponse
    {
        try {
            $response = WhatsappAccountService::index($request, $companyId);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Cuentas de whatsapp obtenidas correctamente',
                'data' => $response,
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappAccountController@index: $message");

            return response()->json([
                'status' => $code,
                'title' => 'Ocurrió un error',
                'details' => $message,
            ], $code);
        }
    }

    /**
     * Summary of show
     * Obtener una cuenta de whatsapp de una empresa.
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
            $response = WhatsappAccountService::show($companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Cuenta de whatsapp obtenida correctamente',
                'data' => $response,
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappAccountController@show: $message");

            return response()->json([
                'status' => $code,
                'title' => 'Ocurrió un error',
                'details' => $message,
            ], $code);
        }
    }

    /**
     * Summary of store
     * Crear una nueva cuenta de whatsapp para una empresa.
     * 
     * @param WhatsappAccountStoreRequest $request
     * @param string $companyId
     * @return JsonResponse
     */
    public static function store(
        WhatsappAccountStoreRequest $request,
        string $companyId
    ): JsonResponse
    {
        try {
            $response = WhatsappAccountService::store($request, $companyId);

            return response()->json([
                'status' => 201,
                'title' => 'Completado',
                'details' => 'Cuenta de whatsapp creada correctamente',
                'data' => $response,
            ], 201);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappAccountController@store: $message");

            return response()->json([
                'status' => $code,
                'title' => 'Ocurrió un error',
                'details' => $message,
            ], $code);
        }
    }

    /**
     * Summary of update
     * Actualizar una cuenta de whatsapp de una empresa.
     * 
     * @param WhatsappAccountUpdateRequest $request
     * @param string $companyId
     * @param string $id
     * @return JsonResponse
     */
    public static function update(
        WhatsappAccountUpdateRequest $request,
        string $companyId,
        string $id
    ): JsonResponse
    {
        try {
            $response = WhatsappAccountService::update($request, $companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Cuenta de whatsapp actualizada correctamente',
                'data' => $response,
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappAccountController@update: $message");

            return response()->json([
                'status' => $code,
                'title' => 'Ocurrió un error',
                'details' => $message,
            ], $code);
        }
    }

    /**
     * Summary of delete
     * Eliminar una cuenta de whatsapp de una empresa.
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
            WhatsappAccountService::delete($companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Cuenta de whatsapp eliminada correctamente',
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("WhatsappAccountController@delete: $message");

            return response()->json([
                'status' => $code,
                'title' => 'Ocurrió un error',
                'details' => $message,
            ], $code);
        }
    }
}
