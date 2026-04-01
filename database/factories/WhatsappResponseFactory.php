<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\WhatsappResponse>
 */
class WhatsappResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "company_id" => Company::inRandomOrder()->first()->id,
            "name" => "not_available",
            "default" => true,
            "message" => "Lo sentimos, las respuestas a este chat no están disponibles.",
        ];
    }
}
