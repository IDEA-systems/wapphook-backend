<?php

namespace App\Http\Middleware;

use App\Repositories\verify_tokens\VerifyTokenRepository;
use App\Services\companies\CompanyService;
use App\Services\verify_tokens\VerifytokenService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebhookMiddleware
{
    public function deniedResponse()
    {
        return response()->json([
            "name" => "Access denied",
            "message" => "Incorrect credentials"
        ], 403);
    }

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Token de verificacion del webhook
        $verify_token = $request->query('hub_verify_token');

        // Query donde viene el company_id
        $company_id = $request->route('company_id');

        if (!$verify_token || !$company_id) {
            return $this->deniedResponse();
        }

        $company = CompanyService::show($company_id);

        if (!$company) {
            return $this->deniedResponse();
        }

        $webhookToken = VerifytokenService::show($verify_token, $company_id);
        
        if (!$webhookToken) {
            return $this->deniedResponse();
        }

        return $next($request);
    }
}
