<?php

namespace App\Support;

/**
 * Summary of ConstantSupport
 * Esta clase proporciona métodos estáticos para acceder a constantes de configuración 
 * relacionadas con el sistema de mensajería de WhatsApp.
 * 
 * Registre aqui todas las constantes que se utilizan en la aplicación para los mensajes de whatsapp, como status, badge, etc.
 * De esta manera, si alguna constante cambia, solo debes actualizarla aquí y se reflejará en toda la aplicación, 
 * evitando errores y facilitando el mantenimiento del código.
 * 
 */
class ConstantSupport
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function graphURL()
    {
        return config('constants.graph_url');
    }

    public static function statusUnread()
    {
        return config('constants.status_unread');
    }

    public static function statusRead()
    {
        return config('constants.status_read');
    }

    public static function messageAll()
    {
        return config('constants.all');
    }

    public static function badgeInput()
    {
        return config('constants.input');
    }

    public static function badgeOutput()
    {
        return config('constants.output');
    }

    public static function messageText()
    {
        return config('constants.message_text');
    }

    public static function messageImage()
    {
        return config('constants.message_image');
    }

    public static function messageVideo()
    {
        return config('constants.message_video');
    }

    public static function messageAudio()
    {
        return config('constants.message_audio');
    }

    public static function messageDocument()
    {
        return config('constants.message_document');
    }

    public static function messageLocation()
    {
        return config('constants.message_location');
    }
    
    public static function messageContact()
    {
        return config('constants.message_contact');
    }

    public static function messageError()
    {
        return config('constants.message_error');
    }

    public static function eventMessages()
    {
        return config('constants.event_messages');
    }

    public static function eventStatuses()
    {
        return config('constants.event_statuses');
    }
}
