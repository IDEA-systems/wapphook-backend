<?php

namespace App\Observers;

use App\Models\WhatsappMessage;
use App\Support\ConstantSupport;
use App\Services\logs\LogService;
use App\Repositories\whatsapp_chats\WhatsappChatRepository;

class WhatsappMessageObserverProcess
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function create(WhatsappMessage $whatsappMessage)
    {
        $filters = [
            "status" => ConstantSupport::statusUnread(),
            "badge" => ConstantSupport::badgeInput()
        ];
        
        $unreadMessages = WhatsappChatRepository::count(
            $whatsappMessage->company_id, 
            $whatsappMessage->whatsapp_chat_id, 
            $filters
        );

        $data = [
            "last_message" => $whatsappMessage->text,
            "unread_messages" => $unreadMessages
        ];

        WhatsappChatRepository::update(
            $whatsappMessage->company_id, 
            $whatsappMessage->whatsapp_chat_id,
            $data
        );
        
        $logData = json_encode($whatsappMessage);
        LogService::activity($logData);
    }
}