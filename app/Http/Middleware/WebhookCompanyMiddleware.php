<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\companies\CompanyRepository;

class WebhookCompanyMiddleware
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
                "No encontrado", 
                "La ruta solicitada no existe", 
                404
            );
        }

        return $next($request);
    }
}
