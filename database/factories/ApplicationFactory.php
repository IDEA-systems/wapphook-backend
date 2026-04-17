<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // "id" => "1552161089185160",
            'id' => (string) $this->faker->randomNumber(9, true),
            "company_id" => Company::inRandomOrder()->first()->id,
            "name" => $this->faker->name()
        ];
    }
}
