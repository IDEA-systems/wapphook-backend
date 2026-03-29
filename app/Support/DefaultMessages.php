<?php

namespace App\Support;

class DefaultMessages
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function notAvailable()
    {
        return config('messages.not_available');
    }
}
