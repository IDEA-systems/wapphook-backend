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

    public static function default(string $company_id)
    {
        return ShowWhatsappResponseRepository::default($company_id);
    }
}
