<?php

namespace App\Services\whatsapp_numbers;

use App\Http\Requests\PaginationRequest;
use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexWhatsappNumberService
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
     * Lógica para obtener los números de whatsapp de una empresa con filtros y paginación
     * 
     * @param PaginationRequest $request
     * @param string $companyId
     * @return LengthAwarePaginator
     */
    public static function index(
        PaginationRequest $request, 
        string $companyId
    ) : LengthAwarePaginator
    {
        $filters = $request->only([
            'whatsapp_account_id',
            'pin',
            'params',
        ]);

        $pagination = $request->only([
            'rows',
            'page',
            'order',
            'sort',
        ]);

        return WhatsappNumberRepository::index($companyId, $filters, $pagination);
    }
}
