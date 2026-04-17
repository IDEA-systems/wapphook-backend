<?php

namespace App\Services\whatsapp_accounts;

use App\Http\Requests\WhatsappAccountStoreRequest;
use App\Models\WhatsappAccount;
use App\Repositories\whatsapp_accounts\WhatsappAccountRepository;

class StoreWhatsappAccountService
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
     * Crear una nueva cuenta de WhatsApp para una empresa específica.
     * 
     * @param WhatsappAccountStoreRequest $request
     * @param string $companyId
     * @return WhatsappAccount
     */
    public static function store(
        WhatsappAccountStoreRequest $request,
        string $companyId
    ): WhatsappAccount
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $application_id = $request->input('application_id');

        $whatsappAccount = WhatsappAccountRepository::show($companyId, $id);

        if ($whatsappAccount) {
            throw new \Exception('La cuenta de whatsapp ya existe', 400);
        }

        return WhatsappAccountRepository::store([
            'id' => $id,
            'company_id' => $companyId,
            'application_id' => $application_id,
            'name' => $name,
        ]);
    }
}
