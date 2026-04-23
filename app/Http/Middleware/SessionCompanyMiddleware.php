<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\companies\CompanyRepository;

/**
 * Middleware para verificar el acceso a los recursos de una empresa específica.
 * 
 * Este middleware se encarga de validar que el usuario autenticado tenga acceso a los recursos de la empresa indicada en la ruta.
 * Si el usuario no tiene acceso, se devuelve una respuesta JSON con un mensaje de error y un código de estado 403 (Prohibido).
 */
class SessionCompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Importante para evitar reenviar a paginas por defecto que no existe en la API
        // Ejemplo: Route [login] not defined. Si el token es inválido o ha expirado.
        // Laravel intenta redirigir a la ruta 'login' por defecto, lo que no existe en esta API.
        $request->headers->set('Accept', 'application/json');
        
        $companyId = $request->route('companyId');

        $company = CompanyRepository::show($companyId);

        if (!$company) {
            return response()->json([
                "name" => "No autorizado",
                "message" => "Los recursos solicitados no existen"
            ], 400);
        }

        $user = $request->user();

        if ($user->company_id != $company->id) {
            return response()->json([
                "name" => "No autorizado",
                "message" => "Los datos de autenticación son incorrectos"
            ], 403);
        }

        return $next($request);
    }
}
