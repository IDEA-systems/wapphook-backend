<?php

namespace App\Services\verify_tokens;

use App\Models\VerifyToken;
use App\Repositories\verify_tokens\VerifyTokenRepository;

class ShowVerifyTokenService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function show(
        string $companyId,
        string $id
    ): VerifyToken {
        $verifyToken = VerifyTokenRepository::show($companyId, $id);

        if (!$verifyToken) {
            throw new \Exception('El token seleccionado no existe', 400);
        }

        return $verifyToken;
    }
}
