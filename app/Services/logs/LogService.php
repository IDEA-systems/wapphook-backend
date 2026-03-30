<?php

namespace App\Services\logs;

class LogService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    
    public static function whatsappEntries($message)
    {
        \Log::channel('whatsapp_entries')
            ->info("Mensaje recibido:\n{$message}\n\n");
    }

    public static function whatsappOutput($message)
    {
        \Log::channel('whatsapp_output')
            ->info("Mensaje enviado:\n{$message}\n\n");
    }

    public static function whatsappStatuses($message)
    {
        \Log::channel('whatsapp_statuses')
            ->info("Mensaje actualizado:\n{$message}\n\n");
    }

    public static function error($message)
    {
        \Log::channel('errors')
            ->error($message);
    }
}
