<?php

namespace App\Repositories\verify_tokens;

use App\Models\VerifyToken;
use App\Services\logs\LogService;

class DeleteVerifyTokenRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function delete(string $companyId, string $id): void
    {
        try {
            VerifyToken::where('company_id', $companyId)
                ->where('id', $id)
                ->delete();
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("DeleteVerifyTokenRepository@delete: $errorMessage");
            throw new \Exception("Error al eliminar el token de verificación", 500);
        }
    }
}
