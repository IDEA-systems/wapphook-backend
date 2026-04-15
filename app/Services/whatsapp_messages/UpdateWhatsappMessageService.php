<?php

namespace App\Services\whatsapp_messages;

use Illuminate\Http\Request;
use App\Repositories\whatsapp_messages\WhatsappMessageRepository;

class UpdateWhatsappMessageService
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
     * Actualizar un mensaje de whatsapp específico de un chat para una empresa dada.
     * 
     * @param Request $request
     * @param string $companyId
     * @param string $whatsappChatId
     * @param string $id
     * @return bool|int
     */
    public static function update(
        Request $request, 
        string $companyId, 
        string $whatsappChatId, 
        string $id
    ): bool|int
    {
        $messageData = WhatsappMessageRepository::show($companyId, $whatsappChatId, $id);

        if (!$messageData) {
            throw new \Exception("El mensaje seleccionado no existe para la empresa y chat especificados.", 400);
        }

        $whatsappChatId = isset($request->whatsapp_chat_id) 
            ? $request->whatsapp_chat_id 
            : $messageData->whatsapp_chat_id;

        $type = isset($request->type) 
            ? $request->type : 
            $messageData->type;

        $badge = isset($request->badge) 
            ? $request->badge : 
            $messageData->badge;

        $audio = isset($request->audio) 
            ? $request->audio : 
            $messageData->audio;

        $contacts = isset($request->contacts) 
            ? $request->contacts : 
            $messageData->contacts;

        $document = isset($request->document) 
            ? $request->document : 
            $messageData->document;

        $image = isset($request->image) 
            ? $request->image : 
            $messageData->image;

        $location = isset($request->location) 
            ? $request->location : 
            $messageData->location;

        $text = isset($request->text) 
            ? $request->text : 
            $messageData->text;

        $video = isset($request->video) 
            ? $request->video : 
            $messageData->video;

        $error = isset($request->error) 
            ? $request->error : 
            $messageData->error;

        $messages = isset($request->messages) 
            ? $request->messages : 
            $messageData->messages;

        $status = isset($request->status) 
            ? $request->status : 
            $messageData->status;
            
        return WhatsappMessageRepository::update($companyId, $whatsappChatId, $id, [
            'whatsapp_chat_id' => $whatsappChatId,
            'type' => $type,
            'badge' => $badge,
            'audio' => $audio,
            'contacts' => $contacts,
            'document' => $document,
            'image' => $image,
            'location' => $location,
            'text' => $text,
            'video' => $video,
            'error' => $error,
            'messages' => $messages,
            'status' => $status,
        ]);
    }
}