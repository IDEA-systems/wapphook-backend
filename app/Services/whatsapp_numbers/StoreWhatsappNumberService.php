<?php

namespace App\Services\whatsapp_numbers;

use App\Models\WhatsappNumber;
use App\Repositories\whatsapp_numbers\StoreWhatsappNumberRepository;
use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $id = $request->input('id');
        $whatsapp_account_id = $request->input('whatsapp_account_id');
        $name_visible = $request->input('name_visible');
        $phone_number = $request->input('phone_number');
        $api_key = $request->input('api_key');
        $pin = $request->input('pin');

        $whatsappNumber = WhatsappNumberRepository::show($companyId, $id);

        if ($whatsappNumber) {
            throw new \Exception("El numero de whatsapp ya existe", 400);
        }

        return WhatsappNumberRepository::store([
            'id' => $id,
            'company_id' => $companyId,
            'whatsapp_account_id' => $whatsapp_account_id,
            'name_visible' => $name_visible,
            'phone_number' => $phone_number,
            'api_key' => $api_key,
            'pin' => $pin,
        ]);
    }
}
