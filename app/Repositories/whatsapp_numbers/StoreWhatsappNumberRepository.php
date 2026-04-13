<?php

namespace App\Repositories\whatsapp_numbers;

use App\Models\WhatsappNumber;
use App\Services\logs\LogService;

class StoreWhatsappNumberRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of store
     * @param mixed $data
     * @throws \Exception
     * @return WhatsappNumber
     */
    public static function store($data): WhatsappNumber
    {
        try {
            return WhatsappNumber::create($data);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("StoreWhatsappNumberRepository@store: $message");
            throw new \Exception("Error al crear el numero de whatsapp", 500);
        }
    }
}
