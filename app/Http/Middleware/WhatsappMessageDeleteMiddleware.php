<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WhatsappMessageDeleteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $canDelete = $request->user()->tokenCan('whatsapp_messages.delete');

        if (!$canDelete) {
            return response()->json([
                'name' => 'Permiso denegado',
                'message' => 'No tienes permiso para eliminar mensajes de WhatsApp.'
            ], 403);
        }

        return $next($request);
    }
}
