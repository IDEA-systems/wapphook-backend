<?php

namespace App\Repositories\companies;

use App\Models\Company;
use App\Services\logs\LogService;

class StoreCompanyRepository
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
     * Crea una nueva compañía con los datos proporcionados.
     * 
     * @param array $data
     * @throws \Exception
     * @return Company
     */
    public static function store(array $data)
    {
        try {
            return Company::create($data);
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("StoreCompanyRepository@store: $errorMessage");
            throw new \Exception("Error al crear la compañía", 500);
        }
    }
}
