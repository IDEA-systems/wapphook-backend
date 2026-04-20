<?php

namespace App\Http\Controllers;

use App\Services\authentication\AuthenticationService;
use App\Services\logs\LogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Summary of login
     * Iniciar la session de un usuario.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public static function login(Request $request): JsonResponse
    {
        try {
            $loginData = AuthenticationService::login($request);

            return response()->json([
                'status' => 200,
                'title' => 'Login successful',
                'details' => 'The user has been logged in successfully.',
                'data' => $loginData,
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("AuthenticationController@login: $message");

            return response()->json([
                'status' => $code,
                'name' => "Login error",
                'message' => $message,
            ], $code);
        }
    }

    /**
     * Handle the logout process.
     * Destruir una session iniciada de un usuario
     *
     * @param Request $request
     * @return JsonResponse
     */
    public static function logout(Request $request): JsonResponse
    {
        try {
            AuthenticationService::logout($request);

            return response()->json([
                'status' => 200,
                'title' => 'Logout successful',
                'details' => 'The user has been logged out successfully.',
            ], 200);
        } catch (\Exception $error) {
            $code = $error->getCode() ?: 500;
            $message = $error->getMessage();
            LogService::error("AuthenticationController@logout: $message");

            return response()->json([
                'status' => $code,
                'name' => "Logout error",
                'message' => $message,
            ], $code);
        }
    }
}
