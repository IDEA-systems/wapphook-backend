<?php

namespace App\Services\whatsapp_numbers;

use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;

class WhatsappNumberService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of show
     * Lógica para mostrar un numero de telefono de whatsapp específico
     * 
     * @param mixed $id
     * @throws \Exception
     * @return \App\Models\WhatsappNumber
     */
    public static function show(string $id, string $company_id)
    {
        $number = WhatsappNumberRepository::show($id, $company_id);  

        if (!$number) {
            throw new \Exception("El numero seleccionado no existe", 400);
        }

        return $number;
    }
}
