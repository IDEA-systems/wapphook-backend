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
     * @param mixed $id
     * @throws \Exception
     * @return \App\Models\VerifyToken
     */
    public static function show(string $id, string $company_id)
    {
        $verifyToken = VerifyTokenRepository::show($id, $company_id);

        if (!$verifyToken) {
            throw new \Exception("El token seleccionado no existe", 404);
        }

        return $verifyToken;
    }
}
