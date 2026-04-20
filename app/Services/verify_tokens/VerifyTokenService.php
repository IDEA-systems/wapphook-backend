<?php

namespace App\Services\verify_tokens;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\VerifyTokenStoreRequest;
use App\Http\Requests\VerifyTokenUpdateRequest;
use App\Models\VerifyToken;
use Illuminate\Pagination\LengthAwarePaginator;

class VerifyTokenService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public static function index(
        PaginationRequest $request,
        string $companyId
    ): LengthAwarePaginator {
        return IndexVerifyTokenService::index($request, $companyId);
    }

    public static function show(
        string $companyId,
        string $id
    ): VerifyToken {
        return ShowVerifyTokenService::show($companyId, $id);
    }

    public static function store(
        VerifyTokenStoreRequest $request,
        string $companyId
    ): VerifyToken {
        return StoreVerifyTokenService::store($request, $companyId);
    }

    public static function update(
        VerifyTokenUpdateRequest $request,
        string $companyId,
        string $id
    ): VerifyToken
    {
        return UpdateVerifyTokenService::update($request, $companyId, $id);
    }

    public static function delete(
        string $companyId,
        string $id
    ): void {
        DeleteVerifyTokenService::delete($companyId, $id);
    }
}