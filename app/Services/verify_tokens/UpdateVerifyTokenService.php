<?php

namespace App\Services\verify_tokens;

use App\Http\Requests\VerifyTokenUpdateRequest;
use App\Models\VerifyToken;
use App\Repositories\verify_tokens\VerifyTokenRepository;

class UpdateVerifyTokenService
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
     * Actualizar un token de verificación existente
     *
     * @param VerifyTokenUpdateRequest $request
     * @param string $companyId
     * @param string $id
     * @return VerifyToken
     * @throws \Exception
     */
    public static function update(
        VerifyTokenUpdateRequest $request,
        string $companyId,
        string $id
    ): VerifyToken 
    {
        $verifyToken = VerifyTokenRepository::show($companyId, $id);

        if (!$verifyToken) {
            throw new \Exception('El token seleccionado no existe', 400);
        }

        $applicationId = $request->input('application_id', $verifyToken->application_id);

        return VerifyTokenRepository::update($companyId, $id, [
            'application_id' => $applicationId,
        ]);
    }
}
