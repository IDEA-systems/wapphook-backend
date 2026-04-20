<?php

namespace App\Services\companies;

use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Repositories\companies\CompanyRepository;

class UpdateCompanyService
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
     * Lógica para actualizar una compañía
     * 
     * @param CompanyUpdateRequest $request
     * @param string $id
     * @throws \Exception
     * @return Company
     */
    public static function update(
        CompanyUpdateRequest $request,
        string $id
    ): Company
    {
        $company = CompanyRepository::show($id);

        if (!$company) {
            throw new \Exception('La compania seleccionada no existe', 400);
        }

        $name = $request->input('name', $company->name);
        $email = $request->input('email', $company->email);

        return CompanyRepository::update($id, [
            'name' => $name,
            'email' => $email,
        ]);
    }
}