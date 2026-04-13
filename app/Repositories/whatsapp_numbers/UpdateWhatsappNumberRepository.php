<?php

namespace App\Repositories\whatsapp_numbers;

use App\Models\WhatsappNumber;
use App\Services\logs\LogService;

class UpdateWhatsappNumberRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function update(string $companyId, string $id, array $data)
    {
        try {
            return WhatsappNumber::where('company_id', $companyId)
                ->where('id', $id)
                ->update($data);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("UpdateWhatsappNumberRepository@update: $message");
            throw new \Exception("Error al actualizar el numero de whatsapp", 500);
        }
    }
}
