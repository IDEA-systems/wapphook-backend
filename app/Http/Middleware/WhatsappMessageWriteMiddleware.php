<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WhatsappMessageWriteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $canWrite = $request->user()->tokenCan('whatsapp_messages.write');

        if (!$canWrite) {
            return response()->json([
                'name' => 'Permiso denegado',
                'message' => 'No tienes permiso para escribir mensajes de WhatsApp.'
            ], 403);
        }

        return $next($request);
    }
}
