<?php

namespace App\Repositories\whatsapp_numbers;

use App\Models\WhatsappNumber;
use App\Services\logs\LogService;

class DeleteWhatsappNumberRepository
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
     * Eliminar un número de WhatsApp específico.
     * 
     * @param string $companyId
     * @param string $id
     * @return mixed
    */
    public static function delete(string $companyId, string $id): mixed
    {
        try {
            return WhatsappNumber::where('company_id', $companyId)
                ->where('id', $id)
                ->delete();
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("DeleteWhatsappNumberRepository@delete: $message");
            throw new \Exception("Error al eliminar el numero de whatsapp", 500);
        }
    }
}
