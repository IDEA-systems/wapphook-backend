<?php

namespace App\Repositories\companies;

use App\Models\Company;
use App\Services\logs\LogService;

class UpdateCompanyRepository
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
     * Actualiza los datos de una compañía existente.
     * 
     * @param string $id
     * @param array $data
     * @throws \Exception
     * @return bool|int
     */
    public static function update(string $id, array $data): bool|int
    {
        try {
            return Company::where('id', $id)->update($data);
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("UpdateCompanyRepository@update: $errorMessage");
            throw new \Exception("Error al actualizar la compañía", 500);
        }
    }
}
