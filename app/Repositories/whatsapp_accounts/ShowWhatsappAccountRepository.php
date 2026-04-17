<?php

namespace App\Repositories\whatsapp_accounts;

use App\Models\WhatsappAccount;
use App\Services\logs\LogService;

class ShowWhatsappAccountRepository
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
     * Obtener un numero de whatsapp de la compañia
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return WhatsappAccount|null
     */
    public static function show(
        string $companyId, 
        string $id
    ): WhatsappAccount|null
    {
        try {
            return WhatsappAccount::where('company_id', $companyId)
                ->where('id', $id)
                ->first();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("ShowWhatsappAccountRepository@show: $message");
            throw new \Exception("Error al obtener el numero de whatsapp");
        }
    }
}
