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
    
    public static function entries($message)
    {
        \Log::channel('entries')
            ->info("Mensaje recibido:\n{$message}\n");
    }

    public static function output($message)
    {
        \Log::channel('output')
            ->info("Mensaje enviado:\n{$message}\n");
    }

    public static function statuses($message)
    {
        \Log::channel('statuses')
            ->info("Mensaje actualizado:\n{$message}\n");
    }

    public static function activity($message)
    {
        \Log::channel('activities')
            ->info("Actividad registrada: \n{$message}\n");
    }

    public static function error($message)
    {
        \Log::channel('errors')
            ->error("Error registrado:\n{$message}\n");
    }
}
