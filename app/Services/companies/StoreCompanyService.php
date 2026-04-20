<?php

namespace App\Services\companies;

use App\Http\Requests\CompanyStoreRequest;
use App\Models\Company;
use App\Repositories\companies\CompanyRepository;

class StoreCompanyService
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
     * Lógica para crear una nueva compañía
     * 
     * @param CompanyStoreRequest $request
     * @throws \Exception
     * @return Company
     */
    public static function store(CompanyStoreRequest $request): Company
    {
        $name = $request->input('name');
        $email = $request->input('email');

        return CompanyRepository::store([
            'name' => $name,
            'email' => $email,
        ]);
    }
}