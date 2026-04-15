<?php

namespace App\Services\verify_tokens;

use App\Repositories\verify_tokens\VerifyTokenRepository;

class VerifytokenService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of show
     * Lógica para buscar un token de verificación por su ID
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return \App\Models\VerifyToken
     */
    public static function show(string $companyId, string $id)
    {
        $verifyToken = VerifyTokenRepository::show($companyId, $id);

        if (!$verifyToken) {
            throw new \Exception("El token seleccionado no existe", 400);
        }

        return $verifyToken;
    }
}
