<?php

namespace App\Services\whatsapp_accounts;

use App\Http\Requests\WhatsappAccountIndexRequest;
use App\Repositories\whatsapp_accounts\WhatsappAccountRepository;
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
     * @param WhatsappAccountIndexRequest $request
     * @param string $companyId
     * @return LengthAwarePaginator
     */
    public static function index(
        WhatsappAccountIndexRequest $request,
        string $companyId
    ): LengthAwarePaginator 
    {
        $filters = $request->only(['application_id', 'name']);
        $pagination = $request->only(['rows', 'page', 'order', 'sort']);

        return WhatsappAccountRepository::index($companyId, $filters, $pagination);
    }
}
