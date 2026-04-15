<?php

namespace Tests\Unit;

use App\Models\Application;
use App\Models\Company;
use App\Models\WhatsappAccount;
use App\Models\WhatsappNumber;
use App\Services\whatsapp_numbers\WhatsappNumberService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class WhatsappNumberTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic unit test example.
     */
    public function test_whatsapp_number_index(): void
    {
        $companyData = Company::factory()->create([
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail()
        ]);

        $applicationData = Application::factory()->create([
            'company_id' => $companyData->id,
            'name' => $this->faker->word()
        ]);

        $whatsappAccountData = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'application_id' => $applicationData->id,
            'name' => $this->faker->word()
        ]);

        $pin = $this->faker->randomNumber(6, true);

        WhatsappNumber::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'whatsapp_account_id' => $whatsappAccountData->id,
            'name_visible' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->sha256(),
            'pin' => $pin,
        ]);

        WhatsappNumber::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'whatsapp_account_id' => $whatsappAccountData->id,
            'name_visible' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->sha256(),
            'pin' => $this->faker->randomNumber(6, true),
        ]);

        $request = new Request([
            'whatsapp_account_id' => $whatsappAccountData->id,
            'rows' => 10,
            'page' => 1,
            'sort' => 'created_at',
            'order' => 'desc',
        ]);

        $results = WhatsappNumberService::index($request, $companyData->id);

        echo "Index Whatsapp Numbers:\n" . json_encode($results)."\n";
    
        $this->assertNotEmpty($results);
        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
    }

    public function test_whatsapp_number_show(): void
    {
        $companyData = Company::factory()->create([
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail()
        ]);

        $applicationData = Application::factory()->create([
            'company_id' => $companyData->id,
            'name' => $this->faker->word()
        ]);

        $whatsappAccountData = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'application_id' => $applicationData->id,
            'name' => $this->faker->word()
        ]);

        $whatsappNumberData = WhatsappNumber::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'whatsapp_account_id' => $whatsappAccountData->id,
            'name_visible' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->sha256(),
            'pin' => $this->faker->randomNumber(6, true),
        ]);

        // Resultados de error cuando no existe el número de whatsapp
        // $this->expectException(\Exception::class);
        // $this->expectExceptionMessage("El numero seleccionado no existe para esta compañia");
        // $this->expectExceptionCode(400);

        $result = WhatsappNumberService::show($companyData->id, $whatsappNumberData->id);

        echo "Show Whatsapp Number:\n" . json_encode($result)."\n";
    
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(WhatsappNumber::class, $result);
    }

    public function test_whatsapp_number_store(): void
    {
        $companyData = Company::factory()->create([
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail()
        ]);

        $applicationData = Application::factory()->create([
            'company_id' => $companyData->id,
            'name' => $this->faker->word()
        ]);

        $whatsappAccountData = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'application_id' => $applicationData->id,
            'name' => $this->faker->word()
        ]);

        $request = new Request([
            'id' => $this->faker->randomNumber(8, true),
            'whatsapp_account_id' => $whatsappAccountData->id,
            'name_visible' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->sha256(),
            'pin' => $this->faker->randomNumber(6, true),
        ]);

        $result = WhatsappNumberService::store($request, $companyData->id);

        echo "Store Whatsapp Number:\n" . json_encode($result)."\n";
    
        $this->assertNotEmpty($result);
        $this->assertInstanceOf(WhatsappNumber::class, $result);
    }

    public function test_whatsapp_number_update(): void
    {
        $companyData = Company::factory()->create([
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail()
        ]);

        $applicationData = Application::factory()->create([
            'company_id' => $companyData->id,
            'name' => $this->faker->word()
        ]);

        $whatsappAccountData = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'application_id' => $applicationData->id,
            'name' => $this->faker->word()
        ]);

        $whatsappNumberData = WhatsappNumber::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'whatsapp_account_id' => $whatsappAccountData->id,
            'name_visible' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->sha256(),
            'pin' => $this->faker->randomNumber(6, true),
        ]);

        $request = new Request([
            'name_visible' => "Finanzas ISIS Internet",
        ]);

        $result = WhatsappNumberService::update($request, $companyData->id, $whatsappNumberData->id);

        echo "Update Whatsapp Number:\n" . json_encode($result)."\n";
    
        $this->assertNotEmpty($result);
        $this->assertIsNumeric($result);
    }

    public function test_whatsapp_number_delete(): void
    {
        $companyData = Company::factory()->create([
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail()
        ]);

        $applicationData = Application::factory()->create([
            'company_id' => $companyData->id,
            'name' => $this->faker->word()
        ]);

        $whatsappAccountData = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'application_id' => $applicationData->id,
            'name' => $this->faker->word()
        ]);

        $whatsappNumberData = WhatsappNumber::factory()->create([
            'id' => $this->faker->randomNumber(8, true),
            'company_id' => $companyData->id,
            'whatsapp_account_id' => $whatsappAccountData->id,
            'name_visible' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->sha256(),
            'pin' => $this->faker->randomNumber(6, true),
        ]);

        // Resultados de error cuando no existe el número de whatsapp
        // $this->expectException(\Exception::class);
        // $this->expectExceptionMessage("El numero seleccionado no existe para esta compañia");
        // $this->expectExceptionCode(400);

        $results = WhatsappNumberService::delete($companyData->id, $whatsappNumberData->id);

        echo "Delete Whatsapp Number:\n" . json_encode($results)."\n";
        $this->assertNotEmpty($results);
        $this->assertIsNumeric($results);
    }
}
