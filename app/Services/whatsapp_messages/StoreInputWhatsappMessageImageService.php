<?php

namespace App\Services\whatsapp_messages;

use App\Models\WhatsappMessage;
use App\Repositories\whatsapp_chats\WhatsappChatRepository;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;
use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;
use App\Support\ConstantSupport;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreInputWhatsappMessageImageService
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
     * Almacenar un nuevo mensaje de imagen de whatsapp en un chat específico para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @return WhatsappMessage
     */
    public static function store(
        Request $request, 
        string $companyId,
        string $whatsappChatId
    ): WhatsappMessage
    {
        $entry = $request->entry[0];
        $changes = $entry["changes"][0];
        $value = $changes["value"];
        $metadata = $value["metadata"];
        $messages = $value["messages"][0];

        $type = isset($messages["type"]) ? $messages["type"] : null;
        $image = isset($messages["image"]) ? $messages["image"] : [];
        $mediaId = isset($image["id"]) ? $image["id"] : null;
        $mimeType = isset($image["mime_type"]) ? $image["mime_type"] : "image/jpeg";
        $phoneNumberId = isset($metadata["phone_number_id"]) ? $metadata["phone_number_id"] : null;
        $caption = isset($image["caption"]) ? $image["caption"] : 'Imagen';

        if (!$mediaId) {
            throw new \Exception("El mensaje de imagen no contiene media id", 400);
        }

        $whatsappNumberData = WhatsappNumberRepository::show($companyId, $phoneNumberId);

        if (!$whatsappNumberData) {
            throw new \Exception("El número seleccionado no existe", 400);
        }

        $whatsappChatData = WhatsappChatRepository::show($companyId, $whatsappChatId);

        if (!$whatsappChatData) {
            throw new \Exception("El chat seleccionado no existe", 400);
        }

        $apiKey = $whatsappNumberData->api_key;
        $graphUrl = ConstantSupport::graphURL();

        $mediaResponse = Http::withToken($apiKey)
            ->acceptJson()
            ->get("{$graphUrl}/{$mediaId}");

        if (!$mediaResponse->successful()) {
            throw new \Exception("No se pudo obtener la URL de la imagen en Meta", 400);
        }

        $mediaUrl = $mediaResponse->json("url");

        if (!$mediaUrl) {
            throw new \Exception("Meta no devolvió la URL del archivo de imagen", 400);
        }

        $binaryResponse = Http::withToken($apiKey)->get($mediaUrl);

        if (!$binaryResponse->successful()) {
            throw new \Exception("No se pudo descargar la imagen desde Meta", 400);
        }

        $chatFolder = "whatsapp/chats/$companyId/{$whatsappChatId}";
        $imagesFolder = "{$chatFolder}/images";

        if (!Storage::disk("public")->exists($imagesFolder)) {
            Storage::disk("public")->makeDirectory($imagesFolder);
        }

        $extension = match ($mimeType) {
            "image/png" => "png",
            "image/webp" => "webp",
            "image/gif" => "gif",
            default => "jpg",
        };

        $messageId = $messages["id"] ?? $mediaId;
        $fileName = str_replace(["/", "\\"], "-", $messageId);
        $relativePath = "{$imagesFolder}/{$fileName}.{$extension}";

        Storage::disk("public")->put($relativePath, $binaryResponse->body());
        
        $imageUrl = Storage::disk("public")->url($relativePath);

        return WhatsappMessageRepository::store([
            "company_id" => $companyId,
            "whatsapp_chat_id" => $whatsappChatId,
            "type" => $type,
            "badge" => "input",
            "image" => $imageUrl,
            "text" => $caption,
            "messages" => $messages,
            "status" => "unread",
        ]);
    }
}
