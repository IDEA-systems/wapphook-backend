<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends Factory<WhatsappMessage>
 */
class WhatsappMessageFactory extends Factory
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
            'whatsapp_chat_id' => WhatsappChat::inRandomOrder()->first()->id,
            'type' => 'text',
            'badge' => 'input',
            'text' => $this->faker->text(),
            'status' => 'unread',
        ];
    }
}
