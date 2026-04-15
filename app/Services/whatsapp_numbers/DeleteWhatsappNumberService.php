<?php

namespace App\Services\whatsapp_numbers;

use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;

class DeleteWhatsappNumberService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of destroy
     * Eliminar un número de WhatsApp específico.
     * 
     * @param string $companyId
     * @param string $id
     * @return mixed
     * @throws \Exception
    */
    public static function delete(
        string $companyId, 
        string $id
    ): mixed
    {
        return WhatsappNumberRepository::delete($companyId, $id);
    }
}