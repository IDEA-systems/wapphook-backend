<?php

namespace App\Repositories\whatsapp_accounts;

use App\Models\WhatsappAccount;
use App\Services\logs\LogService;

class StoreWhatsappAccountRepository
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
     * Crear un numero de whatsapp de la compañia
     * 
     * @param array $data
     * @throws \Exception
     * @return WhatsappAccount
     */
    public static function store(array $data): WhatsappAccount
    {
        try {
            return WhatsappAccount::create($data);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("StoreWhatsappAccountRepository@store: $message");
            throw new \Exception("Error al crear el numero de whatsapp");
        }
    }
}
