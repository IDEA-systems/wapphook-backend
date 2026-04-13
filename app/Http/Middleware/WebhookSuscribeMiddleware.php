<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\logs\LogService;
use App\Services\companies\CompanyService;
use Symfony\Component\HttpFoundation\Response;
use App\Services\verify_tokens\VerifytokenService;

class WebhookSuscribeMiddleware
{
    public function deniedResponse(
        $status = 403, 
        $name = "Access denied", 
        $message = "Incorrect credentials"
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
        try {

            // Token de verificacion del webhook
            $companyId = $request->route('company_id');
            $verify_token = $request->query('hub_verify_token');

            if (!$verify_token) {
                return $this->deniedResponse(403);
            }

            // Query donde viene el company_id
            $company = CompanyService::show($companyId);
            $webhookToken = VerifytokenService::show($verify_token, $company->id);
            
            if (!$webhookToken) {
                return $this->deniedResponse(403);
            }

            return $next($request);

        } catch (\Exception $error) {

            $code = $error->getCode() ?: 400;
            LogService::error("WebhookSuscribeMiddleware@handle\n".$error->getMessage());
            return $this->deniedResponse($code);

        }
    }
}
