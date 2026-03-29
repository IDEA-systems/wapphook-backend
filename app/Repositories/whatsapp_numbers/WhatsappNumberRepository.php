<?php

namespace App\Repositories\whatsapp_numbers;

use App\Models\WhatsappNumber;

class WhatsappNumberRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Show a whatsapp number by id.
     *
     * @param mixed $id
     * @return WhatsappNumber
     * @throws \Exception
     */
    public static function show(string $id, string $company_id = null)
    {
        try {
            return WhatsappNumber::where('id', $id)
                ->where('company_id', $company_id)
                ->first();
        } catch (\Exception $error) {
            \Log::channel('error')->error($error->getMessage());
            throw new \Exception("Error al buscar el número de whatsapp", 500);
        }
    }
}
