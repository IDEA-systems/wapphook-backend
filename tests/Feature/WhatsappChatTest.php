<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Company;
use App\Models\User;
use App\Models\WhatsappChat;
use App\Models\WhatsappNumber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WhatsappChatTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_get_chats(): void
    {
        $company = Company::factory()->create([
            'name' => $this->faker->company(),
            'email' => $this->faker->email(),
        ]);

        $application = Application::factory()->create([
            'company_id' => $company->id,
            'name' => $this->faker->word(),
        ]);

        $whatsappNumber = WhatsappNumber::factory()->create([
            'id' => $this->faker->uuid(),
            'company_id' => $company->id,
            'whatsapp_account_id' => $this->faker->uuid(),
            'name_visible' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->sha256(),
            'pin' => $this->faker->numerify('####'),
        ]);

        $whatsappChat = WhatsappChat::factory()->create([
            "id" => "CHAT-" . $this->faker->randomNumber(12),
            'whatsapp_number_id' => $whatsappNumber->id,
            'company_id' => $company->id,
            'from' => $this->faker->randomNumber(12),
            'contact_name' => $this->faker->name(),
            'user_name' => $this->faker->name(),
            'last_message' => $this->faker->sentence(),
            'unread_messages' => $this->faker->numberBetween(0, 10),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ]);

        $login = $this->post('/api/v1/login', [
            'email' => User::inRandomOrder()->first()->email,
            'password' => 'admin',
        ]);

        $response = $this->get('/api/v1/' . $company->id . '/whatsapp-chats', [
            'Authorization' => 'Bearer ' . $login['data']['access_token'],
        ]);

        $response->dump();
        $response->assertStatus(200);
    }
}
