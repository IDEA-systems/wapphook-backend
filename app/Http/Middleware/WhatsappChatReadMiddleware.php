<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WhatsappChatReadMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $canRead = $request->user()->tokenCan('whatsapp_chats.read');

        if (!$canRead) {
            return response()->json([
                'name' => 'Permiso denegado',
                'message' => 'No tienes permiso para leer los chats de WhatsApp.'
            ], 403);
        }

        return $next($request);
    }
}
