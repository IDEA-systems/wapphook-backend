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
    public function deniedResponse(
        $name = "Access denied", 
        $message = "Incorrect credentials",
        $status = 403, 
    ) {
        return response()->json([
            "name" => $name,
            "message" => $message
        ], $status);
    }

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $companyId = $request->route('companyId');

        $company = CompanyRepository::show($companyId);

        if (!$company) {
            return $this->deniedResponse(
                "No autorizado",
                "Los recursos solicitados no existen",
                400
            );
        }

        $user = $request->user();

        if ($user->company_id != $company->id) {
            return $this->deniedResponse(
                "No authorizado",
                "Los datos de autenticación son incorrectos",
                403
            );
        }

        return $next($request);
    }
}
