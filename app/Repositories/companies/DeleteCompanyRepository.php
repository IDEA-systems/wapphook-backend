<?php

namespace App\Repositories\companies;

use App\Models\Company;
use App\Services\logs\LogService;

class DeleteCompanyRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Summary of delete
     * Elimina una compañía existente por su ID.
     * 
     * @param string $id
     * @throws \Exception
     * @return void
     */
    public static function delete(string $id): void
    {
        try {
            Company::where('id', $id)->delete();
        } catch (\Exception $error) {
            $errorMessage = $error->getMessage();
            LogService::error("DeleteCompanyRepository@delete: $errorMessage");
            throw new \Exception("Error al eliminar la compañía", 500);
        }
    }
}
