<?php

namespace App\Services\whatsapp_numbers;

use App\Models\WhatsappNumber;
use App\Repositories\whatsapp_numbers\StoreWhatsappNumberRepository;
use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;
use Illuminate\Http\Request;

class StoreWhatsappNumberService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of store
     * Lógica para crear un nuevo número de whatsapp para una empresa
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $companyId
     * @throws \Exception
     * @return WhatsappNumber
    */
    public static function store(
        Request $request, 
        string $companyId
    ): WhatsappNumber
    {        
        $searchWhatsappNumber = WhatsappNumberRepository::show($companyId, $request->id);

        if ($searchWhatsappNumber) {
            throw new \Exception("Este numero ya esta registrado para esta compañia", 400);
        }

        return WhatsappNumberRepository::store([
            'id' => $request->id,
            'company_id' => $companyId,
            'whatsapp_account_id' => $request->whatsapp_account_id,
            'name_visible' => $request->name_visible,
            'phone_number' => $request->phone_number,
            'api_key' => $request->api_key,
            'pin' => $request->pin,
        ]);
    }
}
