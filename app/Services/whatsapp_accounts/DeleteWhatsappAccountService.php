<?php

namespace App\Services\whatsapp_accounts;

use App\Repositories\whatsapp_accounts\WhatsappAccountRepository;

class DeleteWhatsappAccountService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of delete
     * Servicio para eliminar una cuenta de whatsapp de una empresa
     * 
     * @param string $companyId
     * @param string $id
     * @return void
     */
    public static function delete(
        string $companyId,
        string $id
    ): void 
    {
        $whatsappAccount = WhatsappAccountRepository::show($companyId, $id);

        if (!$whatsappAccount) {
            throw new \Exception('La cuenta de whatsapp no existe', 400);
        }

        WhatsappAccountRepository::delete($companyId, $id);
    }
}
