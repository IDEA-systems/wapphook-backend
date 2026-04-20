<?php

namespace App\Services\users;

use App\Models\User;
use App\Repositories\users\UserRepository;

class ShowUserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function show(
        string $companyId,
        string $id
    ): User
    {
        return UserRepository::show($companyId, $id);
    }
}
