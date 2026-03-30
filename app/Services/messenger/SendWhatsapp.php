<?php

namespace App\Services\messenger;

use App\Support\Constants;

class SendWhatsapp
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function default($from, $phone_number_id, $api_key, $type = "not_available")
    {
        $API_URL = Constants::whatsappAPIURL();
        $url = "{$API_URL}/{$phone_number_id}/messages";
        return DefaultWhatsapp::send($url, $from, $api_key, $type);
    }
}
