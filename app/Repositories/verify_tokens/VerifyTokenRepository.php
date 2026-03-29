<?php

namespace App\Repositories\verify_tokens;

use App\Models\VerifyToken;

class VerifyTokenRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of find
     * 
     * Lógica para buscar un token de verificación por su ID
     * 
     * @param mixed $id
     * @return VerifyToken|null
     * @throws \Exception
     */
    public static function show(string $id, string $company_id)
    {
        try {
            return VerifyToken::where('id', $id)
                ->where('company_id', $company_id)
                ->first();
        } catch (\Exception $error) {
            \Log::channel('error')->error($error->getMessage());
            throw new \Exception("Error al buscar el token de verificación", 500);
        }
    }
}
