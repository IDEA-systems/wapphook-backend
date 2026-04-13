<?php

namespace App\Repositories\whatsapp_numbers;

use App\Models\WhatsappNumber;
use App\Services\logs\LogService;

class ShowWhatsappNumberRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Show a whatsapp number by id.
     * Lógica para mostrar un numero de telefono de whatsapp específico
     *
     * @param string $companyId
     * @param string $id
     * @return WhatsappNumber|null
     * @throws \Exception
     */
    public static function show(string $companyId, string $id): WhatsappNumber|null
    {
        try {
            return WhatsappNumber::where('id', $id)
                ->where('company_id', $companyId)
                ->first();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("ShowWhatsappNumberRepository@show: $message");
            throw new \Exception("Error al buscar el número de whatsapp", 500);
        }
    }
}
