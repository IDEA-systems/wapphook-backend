<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Application;
use App\Models\WhatsappAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WhatsappAccount>
 */
class WhatsappAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'id' => "1676958460334899",
            'id' => (string) $this->faker->randomNumber(9, true),
            'company_id' => Company::inRandomOrder()->first()->id,
            'application_id' => Application::inRandomOrder()->first()->id,
            'name' => $this->faker->firstName,
        ];
    }
}
