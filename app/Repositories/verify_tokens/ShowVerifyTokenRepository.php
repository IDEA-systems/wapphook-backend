<?php

namespace App\Repositories\verify_tokens;

use App\Models\VerifyToken;
use App\Services\logs\LogService;

class ShowVerifyTokenRepository
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
     * Obtiene los datos de un token de verificación por su ID y el ID de la compañía.
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return VerifyToken|null
     */
    public static function show(string $companyId, string $id) : VerifyToken|null
    {
        try {
            return VerifyToken::where('company_id', $companyId)
                ->where('id', $id)
                ->first();
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("ShowVerifyTokenRepository@show: $errorMessage");
            throw new \Exception("Error al buscar el token de verificación", 500);
        }
    }
}
