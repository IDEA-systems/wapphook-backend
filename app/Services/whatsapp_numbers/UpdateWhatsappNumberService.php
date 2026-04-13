<?php

namespace App\Services\whatsapp_numbers;

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

    public static function update(
        Request $request, 
        string $companyId, 
        string $id
    ): bool|int
    {
        $whatsappNumberData = WhatsappNumberRepository::show($companyId, $id);

        if (!$whatsappNumberData) {
            throw new \Exception("Este numero no esta registrado para esta compañia", 400);
        }

        $id = isset($request->id) 
            ? $request->id 
            : $whatsappNumberData->id;

        $whatsapp_account_id = isset($request->whatsapp_account_id) 
            ? $request->whatsapp_account_id 
            : $whatsappNumberData->whatsapp_account_id;

        $name_visible = isset($request->name_visible) 
            ? $request->name_visible 
            : $whatsappNumberData->name_visible;

        $phone_number = isset($request->phone_number) 
            ? $request->phone_number 
            : $whatsappNumberData->phone_number;

        $api_key = isset($request->api_key) 
            ? $request->api_key 
            : $whatsappNumberData->api_key;

        $pin = isset($request->pin) 
            ? $request->pin 
            : $whatsappNumberData->pin;

        return WhatsappNumberRepository::update($companyId, $id, [
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
