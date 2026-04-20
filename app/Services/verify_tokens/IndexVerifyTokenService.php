<?php

namespace App\Services\verify_tokens;

use App\Http\Requests\PaginationRequest;
use App\Repositories\verify_tokens\VerifyTokenRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexVerifyTokenService
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
        $filters = $request->only([
            'application_id',
        ]);

        $pagination = $request->only([
            'rows',
            'page',
            'sort',
            'order',
        ]);

        return VerifyTokenRepository::index($companyId, $filters, $pagination);
    }
}
