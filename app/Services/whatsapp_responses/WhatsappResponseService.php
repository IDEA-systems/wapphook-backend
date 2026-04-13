<?php

namespace App\Services\whatsapp_responses;

use App\Repositories\whatsapp_responses\WhatsappResponseRepository;

class WhatsappResponseService
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
        return WhatsappResponseRepository::default($companyId);
    }
}
