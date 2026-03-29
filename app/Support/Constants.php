<?php

namespace App\Support;

class Constants
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function whatsappAPIURL()
    {
        return config('constants.whatsapp_api_url');
    }
}
