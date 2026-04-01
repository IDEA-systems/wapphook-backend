<?php

namespace App\Services\whatsapp_messages;

use Illuminate\Http\Request;
use App\Models\WhatsappMessage;
use App\Interfaces\StoreWhatsappMessageInterface;

class StoreWhatsappMessageService implements StoreWhatsappMessageInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store(Request $request, string $company_id): WhatsappMessage
    {
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $messages = $value["messages"][0];
        $type = $messages["type"];

        return match ($type) {
            "text" => StoreWhatsappMessageTextService::store($request, $company_id),
            default => throw new \Exception("Tipo de mensaje no soportado: $type", 400)
        };
    }
}
