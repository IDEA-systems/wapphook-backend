<?php

namespace App\Routes;

class IndependentRoutes
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function register()
    {
        LoginRoutes::register();
    }
}
