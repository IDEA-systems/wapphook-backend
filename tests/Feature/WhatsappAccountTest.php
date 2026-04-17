<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Company;
use App\Models\User;
use App\Models\WhatsappAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WhatsappAccountTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Nota para el equipo:
     * Este proyecto mantiene App\Models\User con `extends Model` + `HasApiTokens`.
     * Por esa razón NO usamos `Sanctum::actingAs()` en estos tests feature,
     * porque `actingAs` exige un modelo que implemente Authenticatable.
     *
     * Si alguien decide usar `Sanctum::actingAs()` en tests, primero debe cambiar
     * temporalmente User para extender `Illuminate\Foundation\Auth\User`.
     */
    private function authenticateForCompany(Company $company): array
    {
        $user = User::factory()->create([
            'company_id' => $company->id,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'admin',
        ]);

        $login = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'admin',
        ]);

        $login->assertStatus(200);

        $token = $login->json('data.access_token');

        return [
            'Authorization' => 'Bearer ' . $token,
        ];
    }

    public function test_whatsapp_accounts_index(): void
    {
        $company = Company::factory()->create();
        $application = Application::factory()->create([
            'company_id' => $company->id,
        ]);

        WhatsappAccount::factory()->create([
            'id' => (string) $this->faker->unique()->numerify('##########'),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $this->faker->company(),
        ]);

        $headers = $this->authenticateForCompany($company);

        $response = $this->getJson("/api/v1/{$company->id}/whatsapp-accounts?page=1&rows=10&sort=created_at&order=desc", $headers);

        $response->assertStatus(200)
            ->assertJsonPath('status', 200)
            ->assertJsonPath('details', 'Cuentas de whatsapp obtenidas correctamente');
    }

    public function test_whatsapp_accounts_show(): void
    {
        $company = Company::factory()->create();
        $application = Application::factory()->create([
            'company_id' => $company->id,
        ]);

        $whatsappAccount = WhatsappAccount::factory()->create([
            'id' => (string) $this->faker->unique()->numerify('##########'),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $this->faker->company(),
        ]);

        $headers = $this->authenticateForCompany($company);

        $response = $this->getJson("/api/v1/{$company->id}/whatsapp-accounts/{$whatsappAccount->id}", $headers);

        $response->assertStatus(200)
            ->assertJsonPath('status', 200)
            ->assertJsonPath('data.id', $whatsappAccount->id);
    }

    public function test_whatsapp_accounts_store(): void
    {
        $company = Company::factory()->create();
        $application = Application::factory()->create([
            'company_id' => $company->id,
        ]);

        $headers = $this->authenticateForCompany($company);

        $payload = [
            'id' => (string) $this->faker->unique()->numerify('##########'),
            'application_id' => $application->id,
            'name' => $this->faker->company(),
        ];

        $response = $this->postJson("/api/v1/{$company->id}/whatsapp-accounts", $payload, $headers);

        $response->assertStatus(201)
            ->assertJsonPath('status', 201)
            ->assertJsonPath('data.id', $payload['id']);

        $this->assertDatabaseHas('whatsapp_accounts', [
            'id' => $payload['id'],
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $payload['name'],
        ]);
    }

    public function test_whatsapp_accounts_update(): void
    {
        $company = Company::factory()->create();
        $application = Application::factory()->create([
            'company_id' => $company->id,
        ]);

        $whatsappAccount = WhatsappAccount::factory()->create([
            'id' => (string) $this->faker->unique()->numerify('##########'),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => 'Cuenta inicial',
        ]);

        $headers = $this->authenticateForCompany($company);

        $payload = [
            'name' => 'Cuenta actualizada',
        ];

        $response = $this->putJson("/api/v1/{$company->id}/whatsapp-accounts/{$whatsappAccount->id}", $payload, $headers);

        $response->assertStatus(200)
            ->assertJsonPath('status', 200)
            ->assertJsonPath('details', 'Cuenta de whatsapp actualizada correctamente');

        $this->assertDatabaseHas('whatsapp_accounts', [
            'id' => $whatsappAccount->id,
            'company_id' => $company->id,
            'name' => $payload['name'],
        ]);
    }

    public function test_whatsapp_accounts_delete(): void
    {
        $company = Company::factory()->create();
        $application = Application::factory()->create([
            'company_id' => $company->id,
        ]);

        $whatsappAccount = WhatsappAccount::factory()->create([
            'id' => (string) $this->faker->unique()->numerify('##########'),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $this->faker->company(),
        ]);

        $headers = $this->authenticateForCompany($company);

        $response = $this->deleteJson("/api/v1/{$company->id}/whatsapp-accounts/{$whatsappAccount->id}", [], $headers);

        $response->assertStatus(200)
            ->assertJsonPath('status', 200)
            ->assertJsonPath('details', 'Cuenta de whatsapp eliminada correctamente');

        $this->assertDatabaseMissing('whatsapp_accounts', [
            'id' => $whatsappAccount->id,
            'company_id' => $company->id,
        ]);
    }
}