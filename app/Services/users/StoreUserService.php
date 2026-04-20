<?php

namespace App\Services\users;

use App\Http\Requests\UserStoreRequest;
use App\Repositories\permissions\PermissionRepository;
use App\Repositories\users\UserRepository;

class StoreUserService
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
     * Crear un usuario para una compania con sus permisos.
     *
     * @param UserStoreRequest $request
     * @param string $companyId
     * @return array
     */
    public static function store(
        UserStoreRequest $request,
        string $companyId
    ): array
    {
        return \DB::transaction(function () use ($request, $companyId) {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $abilities = $request->input('abilities', []);
    
            $user = UserRepository::store([
                'company_id' => $companyId,
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);

            $permissions = [];
            
            foreach ($abilities as $ability) {
                $permissions[] = PermissionRepository::store([
                    'company_id' => $companyId,
                    'user_id' => $user->id,
                    'ability' => $ability,
                ]);
            }

            return [
                'user' => $user,
                'permissions' => $permissions,
            ];
        });
    }
}
