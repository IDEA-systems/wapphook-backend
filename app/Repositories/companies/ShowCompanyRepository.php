<?php

namespace App\Repositories\companies;

use App\Models\Company;
use App\Services\logs\LogService;

class ShowCompanyRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of show
     * Obtiene los datos de una compañía por su ID.
     * 
     * @param string $id
     * @throws \Exception
     * @return Company|null
     */
    public static function show(string $id)
    {
        try {
            return Company::find($id);
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("ShowCompanyRepository@show: $errorMessage");
            throw new \Exception("Error al obtener la compañía", 500);
        }
    }
}
