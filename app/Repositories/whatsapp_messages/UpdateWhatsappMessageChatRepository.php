<?php

namespace App\Repositories\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Services\logs\LogService;

class UpdateWhatsappMessageChatRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of update
     * 
     * Actualiza un mensaje de whatsapp específico en un chat para una empresa dada.
     * 
     * @param string $companyId
     * @param string $id
     * @param array $data - Datos a actualizar del mensaje (por ejemplo, status, badge, text, etc.).
     * @throws \Exception
     * @return bool|int - Retorna true si la actualización fue exitosa o el número de registros afectados.
     */
    public static function update(
        string $companyId, 
        string $id, 
        array $data
    ): bool|int
    {
        try {
            return WhatsappMessage::where('company_id', $companyId)
                ->where('id', $id)
                ->update($data);
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("UpdateWhatsappMessageChatRepository@update: $message");
            throw new \Exception("Error al actualizar el mensaje de whatsapp");
        }
    }
}
