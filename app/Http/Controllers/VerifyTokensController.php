<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\VerifyTokenStoreRequest;
use App\Http\Requests\VerifyTokenUpdateRequest;
use App\Services\logs\LogService;
use App\Services\verify_tokens\VerifyTokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerifyTokensController extends Controller
{
    /**
     * Summary of index
     * Obtener una lista paginada de tokens de verificación
     * 
     * @param PaginationRequest $request
     * @param string $companyId
     * @return JsonResponse
     */
    public static function index(
        PaginationRequest $request,
        string $companyId
    ): JsonResponse {
        try {
            $response = VerifyTokenService::index($request, $companyId);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Tokens de verificacion obtenidos correctamente',
                'data' => $response,
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("VerifyTokensController@index: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Verify tokens',
                'message' => $message,
            ], $code);
        }
    }

    /**
     * Summary of show
     * Obtener los detalles de un token de verificación
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
    ): JsonResponse {
        try {
            $response = VerifyTokenService::show($companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Token de verificacion obtenido correctamente',
                'data' => $response,
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("VerifyTokensController@show: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Verify tokens',
                'message' => $message,
            ], $code);
        }
    }

    /**
     * Summary of store
     * Crear un nuevo token de verificación
     * 
     * @param VerifyTokenStoreRequest $request
     * @param string $companyId
     * @return JsonResponse
     */
    public static function store(
        VerifyTokenStoreRequest $request,
        string $companyId
    ): JsonResponse {
        try {
            $response = VerifyTokenService::store($request, $companyId);

            return response()->json([
                'status' => 201,
                'title' => 'Completado',
                'details' => 'Token de verificacion creado correctamente',
                'data' => $response,
            ], 201);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("VerifyTokensController@store: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Verify tokens',
                'message' => $message,
            ], $code);
        }
    }

    /**
     * Summary of update
     * Actualizar un token de verificación existente
     * 
     * @param VerifyTokenUpdateRequest $request
     * @param string $companyId
     * @param string $id
     * @return JsonResponse
     */
    public static function update(
        VerifyTokenUpdateRequest $request,
        string $companyId,
        string $id
    ): JsonResponse {
        try {
            $response = VerifyTokenService::update($request, $companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Token de verificacion actualizado correctamente',
                'data' => $response,
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("VerifyTokensController@update: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Verify tokens',
                'message' => $message,
            ], $code);
        }
    }

    /**
     * Summary of delete
     * Eliminar un token de verificación existente
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
    ): JsonResponse {
        try {
            VerifyTokenService::delete($companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Token de verificacion eliminado correctamente',
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("VerifyTokensController@delete: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Verify tokens',
                'message' => $message,
            ], $code);
        }
    }
}
