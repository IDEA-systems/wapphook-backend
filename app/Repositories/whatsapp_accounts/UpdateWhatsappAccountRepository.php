<?php

namespace App\Repositories\whatsapp_accounts;

use App\Models\WhatsappAccount;
use App\Services\logs\LogService;

class UpdateWhatsappAccountRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of update
     * Actualizar un numero de whatsapp de la compañia
     * 
     * Se usa @param WhatsappAccount $model para compatibilidad con observers, events, etc
     * 
     * @param string $companyId
     * @param string $id
     * @param array $data
     * @throws \Exception
     * @return WhatsappAccount
     */
    public static function update(
        string $companyId, 
        string $id, 
        array $data
    ): WhatsappAccount
    {
        try {
            $whatsappAccount = WhatsappAccount::where('company_id', $companyId)
                ->where('id', $id)
                ->first();
                
            $whatsappAccount->update($data);

            return $whatsappAccount;
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("UpdateWhatsappAccountRepository@update: $message");
            throw new \Exception("Error al actualizar el numero de whatsapp");
        }
    }
}