<?php

namespace App\Services\verify_tokens;

use App\Repositories\verify_tokens\VerifyTokenRepository;

class DeleteVerifyTokenService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function delete(
        string $companyId,
        string $id
    ): void {
        $verifyToken = VerifyTokenRepository::show($companyId, $id);

        if (!$verifyToken) {
            throw new \Exception('El token seleccionado no existe', 400);
        }

        VerifyTokenRepository::delete($companyId, $id);
    }
}
