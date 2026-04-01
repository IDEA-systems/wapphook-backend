<?php

namespace App\Support;

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
}
