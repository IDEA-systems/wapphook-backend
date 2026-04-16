<?php

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;

class MarkWhatsappChatRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of mark
     * Marcar mensajes como leídos en un chat de WhatsApp específico.
     * Tambien se deja unread_messages en 0 para el chat, 
     * ya que se asume que al marcar los mensajes como leídos, 
     * el chat no tendrá mensajes no leídos.
     * 
     * @param string $companyId
     * @param string $id
     * @param array $data
     * @return void
     */
    public static function mark(
        string $companyId, 
        string $id,
        array $data
    ): void
    {
        try {
            \DB::transaction(function () use ($companyId, $id, $data) {
                WhatsappChat::where('company_id', $companyId)
                    ->where('id', $id)
                    ->update(['unread_messages' => 0]);

                WhatsappMessage::where('company_id', $companyId)
                    ->where('whatsapp_chat_id', $id)
                    ->update($data);
            });
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
