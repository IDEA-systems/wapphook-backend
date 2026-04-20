<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\logs\LogService;
use App\Services\users\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function index(
        PaginationRequest $request,
        string $companyId
    ): JsonResponse
    {
        try {
            $response = UserService::index($request, $companyId);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Lista de usuarios obtenida',
                'data' => $response
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("UserController@index: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Users',
                'message' => $message
            ], $code);
        }
    }

    public static function show(
        Request $request,
        string $companyId,
        string $id
    ): JsonResponse
    {
        try {
            $response = UserService::show($companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Datos obtenidos',
                'data' => $response
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("UserController@index: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Users',
                'message' => $message
            ], $code);
        }
    }

    /**
     * Summary of store
     * Crear un usuario dentro de una compania con abilities.
     *
     * @param UserStoreRequest $request
     * @param string $companyId
     * @return JsonResponse
     */
    public static function store(
        UserStoreRequest $request,
        string $companyId
    ): JsonResponse
    {
        try {
            $response = UserService::store($request, $companyId);

            return response()->json([
                'status' => 201,
                'title' => 'Completado',
                'details' => 'Usuario creado correctamente',
                'data' => $response,
            ], 201);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("UserController@store: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Users',
                'message' => $message,
            ], $code);
        }
    }

    /**
     * Summary of update
     * Actualizar la informacion de un usuario
     * 
     * @param UserUpdateRequest $request
     * @param string $companyId
     * @param string $id
     * @return JsonResponse
     */
    public static function update(
        UserUpdateRequest $request,
        string $companyId,
        string $id
    ): JsonResponse
    {
        try {
            $response = UserService::update($request, $companyId, $id);

            return response()->json([
                'status' => 200,
                'title' => 'Completado',
                'details' => 'Usuario actualizado correctamente',
                'data' => $response,
            ], 200);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("UserController@store: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Users',
                'message' => $message,
            ], $code);
        }
    }

    public static function delete(
        string $companyId,
        string $id
    ): JsonResponse
    {
        try {
            UserService::delete($companyId, $id);

            return response()->json([
                'status' => 204,
                'title' => 'Completado',
                'details' => 'Usuario creado correctamente'
            ], 204);
        } catch (\Exception $th) {
            $code = $th->getCode() ?: 500;
            $message = $th->getMessage();
            LogService::error("UserController@store: $message");

            return response()->json([
                'status' => $code,
                'name' => 'Users',
                'message' => $message,
            ], $code);
        }
    }
}
