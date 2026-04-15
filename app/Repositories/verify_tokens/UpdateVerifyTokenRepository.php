<?php

namespace App\Repositories\verify_tokens;

use App\Models\VerifyToken;
use App\Services\logs\LogService;

class UpdateVerifyTokenRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of update
     * Actualiza un token de verificación por su ID y el ID de la compañía con los datos proporcionados.
     * 
     * @param string $companyId
     * @param string $id
     * @param array $data
     * @throws \Exception
     * @return bool|null
     */
    public static function update(string $companyId, string $id, array $data) : bool|null
    {
        try {
            return VerifyToken::where('company_id', $companyId)
                ->where('id', $id)
                ->update($data);
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("UpdateVerifyTokenRepository@update: $errorMessage");
            throw new \Exception("Error al actualizar el token de verificación", 500);
        }
    }
}
