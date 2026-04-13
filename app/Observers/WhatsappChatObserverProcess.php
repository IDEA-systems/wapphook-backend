<?php

namespace App\Observers;

use App\Models\WhatsappChat;
use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use App\Services\logs\LogService;
use App\Support\ConstantSupport;

class WhatsappChatObserverProcess
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function create(WhatsappChat $whatsappChat)
    {       
        $logData = json_encode($whatsappChat);
        LogService::activity($logData);
    }
}