<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Company;
use App\Models\VerifyToken;
use App\Models\WhatsappAccount;
use App\Models\WhatsappNumber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebhookTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Summary of test_webhook_subscribe_missing_token
     * Deberia responder con un status 403
     * Responder un status 403 cuando el token de 
     * verificacion no es enviado en los parametros get de la solicitud
     */
    public function test_webhook_subscribe_missing_token(): void
    {
        // Obtener el primer registro de la tabla companies
        $company = Company::factory()->create([
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
        ]);

        $companyId = $company->id;

        $response = $this->get("api/v1/webhook/{$companyId}");

        $response->assertStatus(403);
    }

    /**
     * Summary of test_webhook_subscribe_invalid_company
     * Deberia responder con un status 400 
     * Cuando se envia una solicitud get con una ruta que no existe, 
     * Es decir, con un company_id que no existe en la base de datos
     * 
     * @return void
     */
    public function test_webhook_subscribe_invalid_company(): void
    {
        $response = $this->get("api/v1/webhook/32132165463232?hub_verify_token=4654321321&hub_challenge=123456789&hub_mode=subscribe");

        $response->assertStatus(400);
    }

    /**
     * Summary of test_webhook_subscribe_success
     * Deberia responder con un status 200 
     * Cuando se envia una solicitud get con una ruta que existe, 
     * Es decir, con un company_id que existe en la base de datos 
     * Tambien con un token de verificacion valido 
     * que exista en la tabla de verify_tokens y que este asociado 
     * al company_id que viene en la ruta de la solicitud get
     * 
     * @return void
     * 
     */
    public function test_webhook_subscribe_success(): void 
    {
        // Obtener el primer registro de la tabla companies
        $company = Company::factory()->create([
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
        ]);

        $companyId = $company->id;

        $application = Application::factory()->create([
            'id' => $this->faker->randomDigitNotNull(),
            'name' => $this->faker->userName,
            'company_id' => $companyId,
        ]);

        $application_id = $application->id;

        $verifyToken = VerifyToken::factory()->create([
            'company_id' => $companyId,
            'application_id' => $application_id,
        ]);

        $verify_token_id = $verifyToken->id;

        $response = $this->get("api/v1/webhook/{$companyId}?hub_verify_token={$verify_token_id}&hub_challenge=123456789&hub_mode=subscribe");

        $response->assertStatus(200);
    }

    /**
     * Summary of test_webhook_receive_entry_message_text_error_500
     * 
     * Response un status 500 cuando la solicitud viene con datos incorrectos
     * Esto si alguien envia una solicitud directa al webhook que no sea META
     * 
     * @return void
     */
    public function test_webhook_receive_entry_message_text_error(): void
    {
        $response = $this->postJson("api/v1/webhook/654321321", []);
        $response->assertJson($response->json());
        $response->assertStatus(500);
    }

    /**
     * Summary of test_webhook_receive_entry_message_text_success
     * Deberia responder con un status 200 cuando:
     * 
     * La ruta company_id es correcta y existe en la tabla companies
     * El phone_number_id que viene en el body[metadata] de la solicitud, existe en la tabla de whatsapp_numbers y esta asociado al company_id que viene en la ruta de la solicitud
     * 
     * @return void
     * 
     */
    public function test_webhook_receive_entry_message_text_success(): void
    {
        // Obtener el primer registro de la tabla companies
        $company = Company::factory()->create([
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
        ]);

        $application = Application::factory()->create([
            'id' => $this->faker->randomDigitNotNull(),
            'name' => $this->faker->userName,
            'company_id' => $company->id,
        ]);

        $whatsappAccount = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomDigitNotNull(),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $this->faker->userName,
        ]);

        $whatsappNumber = WhatsappNumber::factory()->create([
            'id' => $this->faker->randomDigitNotNull(),
            'company_id' => $company->id,
            'whatsapp_account_id' => $whatsappAccount->id,
            'name_visible' => $this->faker->userName,
            'phone_number' => $this->faker->phoneNumber,
            'api_key' => $this->faker->sha256,
            'pin' => $this->faker->randomNumber(6, true),
        ]);

        $data = [
            "object" => "whatsapp_business_account",
            "entry" => [
                [
                    "id" => "102290129340398",
                    "changes" => [
                        [
                            "value" => [
                                "messaging_product" => "whatsapp",
                                "metadata" => [
                                    "display_phone_number" => $whatsappNumber->phone_number,
                                    "phone_number_id" => $whatsappNumber->id
                                ],
                                "contacts" => [
                                    [
                                        "profile" => [
                                            "name" => "SheenaNelson"
                                        ],
                                        "wa_id" => "5219371273591"
                                    ]
                                ],
                                "messages" => [
                                    [
                                        "from" => "5219371273591",
                                        "id" => "wamid.HBgLMTY1MDM4Nzk0MzkVAgASGBQzQTRBNjU5OUFFRTAzODEwMTQ0RgA=",
                                        "timestamp" => "1749416383",
                                        "type" => "text",
                                        "text" => [
                                            "body" => "Hola, quiero mas informacion sobre sus servicios"
                                        ]
                                    ]
                                ]
                            ],
                            "field" => "messages"
                        ]
                    ]
                ]
            ]
        ];

        $response = $this->postJson("api/v1/webhook/{$company->id}", $data);
        // $response->dump();
        $response->assertStatus(200);
    }
}
