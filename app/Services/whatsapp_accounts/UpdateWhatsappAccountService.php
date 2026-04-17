<?php

namespace App\Services\whatsapp_accounts;

use App\Http\Requests\WhatsappAccountUpdateRequest;
use App\Models\WhatsappAccount;
use App\Repositories\whatsapp_accounts\UpdateWhatsappAccountRepository;
use App\Repositories\whatsapp_accounts\WhatsappAccountRepository;

class UpdateWhatsappAccountService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function update(
        WhatsappAccountUpdateRequest $request,
        string $companyId,
        string $id
    ): WhatsappAccount
    {
        $whatsappAccount = WhatsappAccountRepository::show($companyId, $id);
        
        if (!$whatsappAccount) {
            throw new \Exception('La cuenta de whatsapp no existe', 400);
        }
            
        $application_id = $request->input('application_id', $whatsappAccount->application_id);
        $name = $request->input('name', $whatsappAccount->name);

        return UpdateWhatsappAccountRepository::update($companyId, $id, [
            'application_id' => $application_id,
            'name' => $name,
        ]);
    }
}
