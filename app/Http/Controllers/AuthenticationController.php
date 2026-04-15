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
                'title' => 'Login successful',
                'details' => 'The user has been logged in successfully.',
                'data' => $loginData,
            ]);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("AuthenticationController@login: $message");

            return response()->json([
                'name' => "LoginError",
                'message' => $message,
            ], 500);
        }
    }

    /**
     * Handle the logout process.
     * Destruir una session iniciada de un usuario
     *
     * @param Request $request
     * @param string $companyId
     * @param string $userId
     * @return JsonResponse
     */
    public static function logout(
        Request $request, 
        string $companyId, 
        string $userId
    ): JsonResponse
    {
        try {
            AuthenticationService::logout($request, $companyId, $userId);

            return response()->json([
                'title' => 'Logout successful',
                'details' => 'The user has been logged out successfully.',
            ]);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("AuthenticationController@logout: $message");

            return response()->json([
                'name' => "LogoutError",
                'message' => $message,
            ], 500);
        }
    }
}
