<?php

namespace App\Repositories\whatsapp_accounts;

use App\Models\WhatsappAccount;
use App\Services\logs\LogService;

class DeleteWhatsappAccountRepository
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
     * Eliminar una cuenta de whatsapp de la compañia
     * 
     * @param mixed $companyId
     * @param mixed $id
     * @throws \Exception
     * @return void
     */
    public static function delete($companyId, $id)
    {
        try {
            $model = WhatsappAccount::where('company_id', $companyId)
                ->where('id', $id)
                ->first();

            $model->delete();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("DeleteWhatsappAccountRepository@delete: $message");
            throw new \Exception("Error al eliminar el numero de whatsapp");
        }
    }
}
