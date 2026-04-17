<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WhatsappNumberReadMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $canRead = $request->user()->tokenCan('whatsapp_numbers.read');

        if (!$canRead) {
            return response()->json([
                'name' => 'Permiso denegado',
                'message' => 'No tienes permiso para leer los números de WhatsApp.'
            ], 403);
        }

        return $next($request);
    }
}
