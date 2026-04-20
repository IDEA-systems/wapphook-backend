<?php

namespace App\Http\Controllers;

use App\Services\logs\LogService;
use App\Services\permissions\PermissionServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Summary of index
     * Obtener los permisos de un usuario por su ID dentro de una compania.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $userId
     * @return JsonResponse
     */
    public function index(
        Request $request, 
        string $companyId, 
        string $userId
    ): JsonResponse
    {
        try {
            $response = PermissionServices::index($companyId, $userId);

            return response()->json([
                "status" => 200,
                "name" => "Permisos obtenidos",
                "message" => "Permisos obtenidos correctamente",
                "data" => $response
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("PermissionController@index: $message");

            return response()->json([
                "status" => $code,
                "name" => "Error",
                "message" => $message
            ], $code);
        }
    }
}
