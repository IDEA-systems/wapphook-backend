<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    | You can specify the paths that should be processed by the CORS middleware.
    |
    */
    'paths' => [
        'api/*', 
        'sanctum/csrf-cookie'
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed Methods
    |--------------------------------------------------------------------------
    | You can configure the allowed HTTP methods here. Use ['*'] to allow all methods.
    | For example, you can specify allowed methods like this:
    | 'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'],
    | or simply use ['*'] to allow all methods.
    |
    */
    'allowed_methods' => [
        'OPTIONS',
        'POST',
        'GET',
        'PUT',
        'PATCH',
        'DELETE',
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins
    |--------------------------------------------------------------------------
    | You can configure the allowed origins here. Use ['*'] to allow all origins.
    | For example, you can specify allowed origins like this:
    | 'allowed_origins' => ['https://example.com', 'https://anotherdomain.com'],
    |
    */
    'allowed_origins' => array_filter(explode(',', env('CORS_ALLOWED_ORIGINS', '*'))),

    /*
    |--------------------------------------------------------------------------
    | Allowed Headers
    |--------------------------------------------------------------------------
    | You can configure the allowed headers here. Use ['*'] to allow all headers.
    | For example, you can specify allowed headers like this:
    | 'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With'],
    | or simply use ['*'] to allow all headers.
    |
    */
    'allowed_headers' => [
        'Accept',
        'Accept-Language',
        'Content-Language',
        'Content-Type',
        'Authorization',
    ],

    'supports_credentials' => false, // si usas cookies
];