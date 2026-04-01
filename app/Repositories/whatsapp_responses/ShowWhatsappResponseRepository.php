<?php

namespace App\Repositories\whatsapp_responses;

use App\Models\WhatsappResponse;
use App\Services\logs\LogService;

class ShowWhatsappResponseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function default(string $company_id)
    {
        try {
            return WhatsappResponse::where("company_id", $company_id)
                ->where("default", true)
                ->first();
        } catch (\Exception $error) {
            LogService::error($error->getMessage());
            throw new \Exception("Error al obtener el mensaje por defecto", 500);
        }
    }
}
