<?php

namespace App\Services\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Repositories\whatsapp_messages\StoreWhatsappMessageRepository;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;
use Illuminate\Http\Request;

class WhatsappMessageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store(Request $request, string $company_id)
    {
        return StoreWhatsappMessageService::store($request, $company_id);
    }
}
