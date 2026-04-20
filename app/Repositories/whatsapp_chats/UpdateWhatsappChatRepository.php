<?

namespace App\Repositories\whatsapp_chats;

use App\Models\WhatsappChat;
use App\Services\logs\LogService;

class UpdateWhatsappChatRepository
{
    /**
     * Summary of update
     * 
     * Actualiza un chat de whatsapp existente con los datos proporcionados.
     * 
     * @param string $companyId company_id para asegurar que el chat pertenece a la empresa
     * @param string $id ID del chat de whatsapp a actualizar
     * @param array $data Datos a actualizar en el chat de whatsapp
     * @throws \Exception
     * @return WhatsappChat
     */
    public static function update(
        string $companyId, 
        string $id, 
        array $data
    ): WhatsappChat
    {
        try {
            $whatsappChat = WhatsappChat::where('company_id', $companyId)
                ->where('id', $id)
                ->first();

            $whatsappChat->update($data);

            return $whatsappChat;
        } catch (\Exception $error) {
            $message = $error->getMessage();
            LogService::error("UpdateWhatsappChatRepository@update: $message");
            throw new \Exception("Error al actualizar el chat de whatsapp", 500);
        }
    }
}