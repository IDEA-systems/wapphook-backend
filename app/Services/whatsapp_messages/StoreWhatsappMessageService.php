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

    public static function store(
        Request $request, 
        string $companyId
    ): WhatsappMessage
    {
        $text = ConstantSupport::messageText();
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $messages = $value["messages"][0];
        $type = $messages["type"];

        return match ($type) {
            $text => StoreWhatsappMessageTextService::store($request, $companyId),
            default => throw new \Exception("Tipo de mensaje desconocido", 400)
        };
    }
}
