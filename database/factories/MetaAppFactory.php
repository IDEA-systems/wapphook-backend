<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\MetaApp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MetaApp>
 */
class MetaAppFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id" => $this->faker->uuid(),
            "company_id" => Company::inRandomOrder()->first()->id,
            "name" => $this->faker->name()
        ];
    }
}
