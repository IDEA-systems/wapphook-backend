<?php

namespace App\Repositories\whatsapp_accounts;

use App\Models\WhatsappAccount;
use Illuminate\Pagination\LengthAwarePaginator;

class WhatsappAccountRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function index(
        string $companyId, 
        array $filters, 
        array $pagination
    ): LengthAwarePaginator
    {
        return IndexWhatsappAccountRepository::index($companyId, $filters, $pagination);
    }

    public static function show(
        string $companyId, 
        string $id
    ): WhatsappAccount|null
    {
        return ShowWhatsappAccountRepository::show($companyId, $id);
    }

    /**
     * Summary of update
     * Almacenar un numero de whatsapp de la compañia
     * 
     * @param array $data
     * @throws \Exception
     * @return WhatsappAccount|null
     */
    public static function store(array $data): WhatsappAccount|null
    {
        return StoreWhatsappAccountRepository::store($data);
    }

    /**
     * Summary of update
     * Actualizar un numero de whatsapp de la compañia
     * 
     * @param string $companyId
     * @param string $id
     * @param array $data
     * @throws \Exception
     * @return WhatsappAccount|null
     */
    public static function update(
        string $companyId, 
        string $id, 
        array $data
    ): void
    {
        UpdateWhatsappAccountRepository::update($companyId, $id, $data);
    }

    /**
     * Summary of delete
     * Eliminar un numero de whatsapp de la compañia
     * 
     * @param string $companyId
     * @param string $id
     * @throws \Exception
     * @return void
     */
    public static function delete(
        string $companyId, 
        string $id
    ): void
    {
        DeleteWhatsappAccountRepository::delete($companyId, $id);
    }
}
