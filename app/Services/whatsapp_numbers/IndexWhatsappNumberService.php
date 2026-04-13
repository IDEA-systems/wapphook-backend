<?php

namespace App\Services\whatsapp_numbers;

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
     * @param \Illuminate\Http\Request $request
     * @param string $companyId
     * @return LengthAwarePaginator
     */
    public static function index(
        Request $request, 
        string $companyId
    ) : LengthAwarePaginator
    {
        $filters = $request->only(['whatsapp_account_id', 'pin', 'params']);
        $params = $request->only(['rows', 'page', 'sort', 'order']);

        return WhatsappNumberRepository::index($companyId, $filters, $params);
    }
}
