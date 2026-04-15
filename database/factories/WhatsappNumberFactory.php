<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\WhatsappAccount;
use App\Models\WhatsappNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WhatsappNumber>
 */
class WhatsappNumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => "1062084873645197",
            'company_id' => Company::inRandomOrder()->first()->id,
            'whatsapp_account_id' => WhatsappAccount::inRandomOrder()->first()->id,
            'name_visible' => $this->faker->firstNameFemale(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->uuid(),
            'pin' => $this->faker->randomNumber()
        ];
    }
}
