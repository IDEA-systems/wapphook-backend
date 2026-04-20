<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $habilities = [
            "applications.read", 
            "applications.write", 
            "applications.delete",
            "personal_access_tokens.read",
            "personal_access_tokens.write",
            "personal_access_tokens.delete",
            "companies.read",
            "companies.write",
            "companies.delete",
            "users.read",
            "users.write",
            "users.delete",
            "verify_tokens.read",
            "verify_tokens.write",
            "verify_tokens.delete",
            "whatsapp_accounts.read",
            "whatsapp_accounts.write",
            "whatsapp_accounts.delete",
            "whatsapp_numbers.read",
            "whatsapp_numbers.write",
            "whatsapp_numbers.delete",
            "whatsapp_chats.read",
            "whatsapp_chats.write",
            "whatsapp_chats.delete",
            "whatsapp_messages.read",
            "whatsapp_messages.write",
            "whatsapp_messages.delete",
        ];
        
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'ability' => $this->faker->randomElement($habilities),
        ];
    }
}
