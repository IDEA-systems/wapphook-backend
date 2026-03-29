<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\MetaApp;
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
            'id' => $this->faker->unique(),
            'company_id' => Company::inRandomOrder()->first()->id,
            'meta_app_id' => MetaApp::inRandomOrder()->first()->id,
            'name' => $this->faker->firstName,
        ];
    }
}
