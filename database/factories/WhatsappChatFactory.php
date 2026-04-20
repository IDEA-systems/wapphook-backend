<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\WhatsappChat;
use App\Models\WhatsappNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WhatsappChat>
 */
class WhatsappChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $phoneNumber = str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $this->faker->phoneNumber());
        $id = "CHAT-$phoneNumber";

        return [
            "id" => $id,
            'whatsapp_number_id' => WhatsappNumber::inRandomOrder()->first()->id,
            'company_id' => Company::inRandomOrder()->first()->id,
            'from' => $phoneNumber,
        ];
    }
}
