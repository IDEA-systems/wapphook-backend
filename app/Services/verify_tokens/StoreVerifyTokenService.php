<?php

namespace App\Services\verify_tokens;

use App\Http\Requests\VerifyTokenStoreRequest;
use App\Models\VerifyToken;
use App\Repositories\verify_tokens\VerifyTokenRepository;

class StoreVerifyTokenService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function store(
        VerifyTokenStoreRequest $request,
        string $companyId
    ): VerifyToken {
        $applicationId = $request->input('application_id');

        return VerifyTokenRepository::store([
            'company_id' => $companyId,
            'application_id' => $applicationId,
        ]);
    }
}
