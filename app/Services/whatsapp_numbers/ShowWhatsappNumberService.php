<?php

namespace App\Services\whatsapp_numbers;

use App\Models\WhatsappNumber;
use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;

class ShowWhatsappNumberService
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
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return WhatsappNumber
     */
    public static function show(
        string $companyId,
        string $id
    ): WhatsappNumber
    {
        $whatsappNumberData = WhatsappNumberRepository::show($companyId, $id);  

        if (!$whatsappNumberData) {
            throw new \Exception("El numero seleccionado no existe para esta compañia", 400);
        }

        return $whatsappNumberData;
    }
}