<?php

namespace App\Services\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Support\ConstantSupport;
use Illuminate\Http\Request;

class StoreWhatsappMessageService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of store
     * Almacenar un nuevo mensaje entrante de whatsapp en un chat específico para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @return WhatsappMessage|null
     */
    public static function input(
        Request $request, 
        string $companyId,
        string $whatsappChatId
    ): WhatsappMessage
    {
        $text = ConstantSupport::messageText();
        $image = ConstantSupport::messageImage();

        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $messages = $value["messages"][0];
        $type = $messages["type"];

        return match ($type) {
            $text => StoreInputWhatsappMessageTextService::store($request, $companyId, $whatsappChatId),
            $image => StoreInputWhatsappMessageImageService::store($request, $companyId, $whatsappChatId),
            default => throw new \Exception("Tipo de mensaje desconocido", 400)
        };
    }

    public static function output(
        Request $request, 
        string $companyId
    ): WhatsappMessage
    {
        $text = ConstantSupport::messageText();
        $messages = $request->post('messages');
        $type = $messages["type"];

        return match ($type) {
            $text => StoreOutputWhatsappMessageTextService::store($request, $companyId),
            default => throw new \Exception("Tipo de mensaje desconocido", 400)
        };
    }
}
