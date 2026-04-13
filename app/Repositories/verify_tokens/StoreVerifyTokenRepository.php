<?php

namespace App\Repositories\verify_tokens;

use App\Models\VerifyToken;
use App\Services\logs\LogService;

class StoreVerifyTokenRepository
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
     * Agrega un nuevo token de verificación a la base de datos con los datos proporcionados.
     *
     * @param array $data
     * @return VerifyToken
     * @throws \Exception
     */
    public static function store(array $data) : VerifyToken
    {
        try {
            return VerifyToken::create($data);
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("StoreVerifyTokenRepository@store: $errorMessage");
            throw new \Exception("Error al crear el token de verificación", 500);
        }
    }
}
