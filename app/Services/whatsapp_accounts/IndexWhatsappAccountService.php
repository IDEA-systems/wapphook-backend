<?php

namespace App\Services\whatsapp_accounts;

use App\Http\Requests\PaginationRequest;
use App\Repositories\whatsapp_accounts\WhatsappAccountRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexWhatsappAccountService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of index
     * 
     * 
     * @param PaginationRequest $request
     * @param string $companyId
     * @return LengthAwarePaginator
     */
    public static function index(
        PaginationRequest $request,
        string $companyId
    ): LengthAwarePaginator 
    {
        $filters = $request->only([
            'application_id', 
            'name'
        ]);
        
        $pagination = $request->only([
            'rows', 
            'page', 
            'sort', 
            'order'
        ]);

        return WhatsappAccountRepository::index($companyId, $filters, $pagination);
    }
}
