<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class
        ]);
    })
    ->withExceptions(function ($exceptions): void {
        $exceptions->render(function (AuthenticationException $error, Request $request) {
            return response()->json([
                "status" => 401,
                "name" => "No autenticado",
                "message" => "No se ha podido autenticar al usuario"
            ], 401);
        });

        $exceptions->render(function (NotFoundHttpException $error, Request $request) {
            return response()->json([
                "status" => 404,
                "name" => "No encontrado",
                "message" => "Recurso no encontrado"
            ], 404);
        });

        $exceptions->render(function (Exception $error, Request $request) {
            return response()->json([
                "status" => 500,
                "name" => "Error interno del servidor",
                "message" => "Ha ocurrido un error inesperado"
            ], 500);
        });

        $exceptions->render(function (Throwable $error, Request $request) {
            return response()->json([
                "status" => 500,
                "name" => "Error interno del servidor",
                "message" => "Ha ocurrido un error inesperado"
            ], 500);
        });
    })->create();
