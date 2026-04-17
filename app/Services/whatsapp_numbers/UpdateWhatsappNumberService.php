<?php

namespace App\Services\whatsapp_numbers;

use App\Http\Requests\WhatsappNumberUpdateRequest;
use App\Repositories\whatsapp_numbers\WhatsappNumberRepository;
use Illuminate\Http\Request;

class UpdateWhatsappNumberService
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
     * Lógica para actualizar un número de whatsapp de una empresa
     * 
     * @param WhatsappNumberUpdateRequest $request
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return bool|int
     */
    public static function update(
        WhatsappNumberUpdateRequest $request, 
        string $companyId, 
        string $id
    ): bool|int
    {
        $whatsappNumberData = WhatsappNumberRepository::show($companyId, $id);

        if (!$whatsappNumberData) {
            throw new \Exception("Este numero no esta registrado para esta compañia", 400);
        }

        $whatsapp_account_id = $request->input(
            'whatsapp_account_id', 
            $whatsappNumberData->whatsapp_account_id
        );
        
        $name_visible = $request->input(
            'name_visible', 
            $whatsappNumberData->name_visible
        );

        $phone_number = $request->input(
            'phone_number', 
            $whatsappNumberData->phone_number
        );

        $api_key = $request->input(
            'api_key', 
            $whatsappNumberData->api_key
        );

        $pin = $request->input(
            'pin', 
            $whatsappNumberData->pin
        );
            
        return WhatsappNumberRepository::update($companyId, $id, [
            'company_id' => $companyId,
            'whatsapp_account_id' => $whatsapp_account_id,
            'name_visible' => $name_visible,
            'phone_number' => $phone_number,
            'api_key' => $api_key,
            'pin' => $pin,
        ]);
    }
}
