<?php

return [
    
    /**
     * URL base para las solicitudes a la API de Facebook Graph. 
     * Se utiliza para interactuar con los servicios de WhatsApp Business API.
     * 
     */
    'graph_url' => 'https://graph.facebook.com/v25.0',

    /**
     * Status de los mensajes de whatsapp.
     * Se utiliza para definir los posibles estados de un mensaje de whatsapp, como 'unread', 'read', 'sent', etc.
     * Estos estados pueden ser utilizados para filtrar mensajes, actualizar su estado, etc.
     * Si algun status cambia solo debes actualizarlo aquí y se reflejará en toda la aplicación.
     * 
     */
    'status_read' => 'read', // Mensaje leído
    'status_unread' => 'unread', // Mensaje no leído

    /**
     * Badge de los mensajes de whatsapp.
     * Se utiliza para definir los posibles badges de un mensaje de whatsapp, como 'input', 'output', etc.
     * Estos badges pueden ser utilizados para filtrar mensajes, actualizar su badge, etc.
     * Si algun badge cambia solo debes actualizarlo aquí y se reflejará en toda la aplicación.
     * 
     */
    'input' => 'input', // Mensaje entrante
    'output' => 'output', // Mensaje saliente

    /**
     * Tipos de mensajes de whatsapp.
     * Se utiliza para definir los posibles tipos de un mensaje de whatsapp, como 'text', 'image', 'video', etc.
     * Estos tipos pueden ser utilizados para filtrar mensajes, actualizar su tipo, etc.
     * Si algun tipo cambia solo debes actualizarlo aquí y se reflejará en toda la aplicación.
     * 
     */
    'message_text' => 'text', // Mensaje de texto
    'message_image' => 'image', // Mensaje de imagen
    'message_video' => 'video', // Mensaje de video
    'message_audio' => 'audio', // Mensaje de audio
    'message_document' => 'document', // Mensaje de documento
    'message_location' => 'location', // Mensaje de ubicación
    'message_contact' => 'contact', // Mensaje de contacto
    'message_error' => 'error', // Mensaje de error

    /**
     * Tipos de eventos de whatsapp.
     * Se utiliza para definir los posibles tipos de eventos de whatsapp, como 'messages', 'statuses', etc.
     * 
     */
    'event_messages' => 'messages', // Evento de mensajes
    'event_statuses' => 'statuses', // Evento de estados
];
