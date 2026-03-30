<?php

namespace App\Repositories\companies;

use App\Models\Company;
use App\Services\logs\LogService;

class CompanyRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Show a company by id.
     *
     * @param mixed $company_id
     * @return Company|null
     * @throws \Exception
     */
    public static function show(string $company_id)
    {
        try {
            return Company::find($company_id);
        } catch (\Exception $error) {
            LogService::error($error->getMessage());
            throw new \Exception("Error al buscar la compañía", 500);
        }
    }
}
