<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Application;
use App\Models\VerifyToken;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VerifyToken>
 */
class VerifyTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::inRandomOrder()->first()->id,
            'application_id' => Application::inRandomOrder()->first()->id,
        ];
    }
}
