<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Requests\PaginationRequest;
use App\Services\companies\CompanyService;
use App\Services\logs\LogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Summary of show
     * Obtener los detalles de una compania
     * 
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public static function show(
        Request $request,
        string $id
    ): JsonResponse
    {
        try {
            $response = CompanyService::show($id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Compania obtenida correctamente',
                'data' => $response,
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("CompanyController@show: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Companies',
                'message' => $message,
            ], $code);
        }
    }

    /**
     * Summary of update
     * Actualizar una compania existente
     * 
     * @param CompanyUpdateRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public static function update(
        CompanyUpdateRequest $request,
        string $id
    ): JsonResponse
    {
        try {
            $response = CompanyService::update($request, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Compania actualizada correctamente',
                'data' => $response,
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("CompanyController@update: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Companies',
                'message' => $message,
            ], $code);
        }
    }

    /**
     * Summary of delete
     * Eliminar una compania existente
     * 
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public static function delete(
        Request $request,
        string $id
    ): JsonResponse
    {
        try {
            CompanyService::delete($id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Compania eliminada correctamente',
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("CompanyController@delete: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Companies',
                'message' => $message,
            ], $code);
        }
    }
}
