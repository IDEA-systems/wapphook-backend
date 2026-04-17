<?php

namespace App\Services\whatsapp_accounts;

use App\Models\WhatsappAccount;
use App\Repositories\whatsapp_accounts\WhatsappAccountRepository;

class ShowWhatsappAccountService
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
     * Obtener los detalles de una cuenta de WhatsApp específica utilizando su ID.
     * 
     * @param string $companyId
     * @param string $id
     * @return WhatsappAccount
     */
    public static function show(
        string $companyId,
        string $id
    ): WhatsappAccount
    {
        $whatsappAccount = WhatsappAccountRepository::show($companyId, $id);

        if (!$whatsappAccount) {
            throw new \Exception('La cuenta de whatsapp no existe', 400);
        }

        return $whatsappAccount;
    }
}
