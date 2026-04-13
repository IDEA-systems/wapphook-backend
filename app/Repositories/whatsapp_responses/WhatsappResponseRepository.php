<?php

namespace App\Repositories\whatsapp_responses;

class WhatsappResponseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function default(string $companyId)
    {
        return ShowWhatsappResponseRepository::default($companyId);
    }
}
