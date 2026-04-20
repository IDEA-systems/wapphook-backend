<?php

namespace App\Repositories\whatsapp_numbers;

use App\Models\WhatsappNumber;
use Illuminate\Pagination\LengthAwarePaginator;

class WhatsappNumberRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Index whatsapp numbers with filters and pagination.
     *
     * @param string $companyId
     * @param array $filters
     * @param array $pagination
     * @return LengthAwarePaginator
     */
    public static function index(
        string $companyId, 
        array $filters = [], 
        array $pagination = []
    ): LengthAwarePaginator
    {
        return IndexWhatsappNumberRepository::index($companyId, $filters, $pagination);
    }

    /**
     * Show a whatsapp number by id.
     *
     * @param string $companyId
     * @param string $id
     * @return WhatsappNumber|null
     * @throws \Exception
     */
    public static function show(
        string $companyId, 
        string $id
    ): WhatsappNumber|null
    {
        return ShowWhatsappNumberRepository::show($companyId, $id);
    }

    /**
     * Store a new whatsapp number.
     *
     * @param array $data
     * @return WhatsappNumber
     * @throws \Exception
     */
    public static function store(array $data): WhatsappNumber
    {
        return StoreWhatsappNumberRepository::store($data);
    }

    /**
     * Update a whatsapp number.
     *
     * @param string $companyId
     * @param string $id
     * @param array $data
     * @return bool|int
     * @throws \Exception
    */
    public static function update(
        string $companyId, 
        string $id, 
        array $data
    ): bool|int
    {
        return UpdateWhatsappNumberRepository::update($companyId, $id, $data);
    }

    /**
     * Delete a whatsapp number.
     *
     * @param string $companyId
     * @param string $id
     * @return mixed
     * @throws \Exception
    */
    public static function delete(
        string $companyId, 
        string $id
    ): mixed
    {
        return DeleteWhatsappNumberRepository::delete($companyId, $id);
    }
}
