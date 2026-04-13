<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Application;
use App\Models\Company;
use App\Models\WhatsappAccount;
use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use App\Models\WhatsappNumber;
use App\Services\whatsapp_messages\WhatsappMessageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator;
use \Illuminate\Http\Request;

class WhatsappMessageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic unit test example.
     */
    public function test_whatsapp_messages_index(): void
    {
        $company = Company::factory()->create([
            'name' => $this->faker->userName(),
            'email' => $this->faker->unique()->companyEmail(),
        ]);

        $application = Application::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'name' => $this->faker->userName(),
        ]);

        $whatsappAccount = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $this->faker->word(),
        ]);

        $whatsappNumber = WhatsappNumber::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'whatsapp_account_id' => $whatsappAccount->id,
            'name_visible' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->uuid(),
            'pin' => "123456",
        ]);

        $whatsappChat = WhatsappChat::factory()->create([
            "id" => $this->faker->uuid(),
            'whatsapp_number_id' => $whatsappNumber->id,
            'company_id' => $company->id,
            'from' => $this->faker->phoneNumber(),
        ]);

        WhatsappMessage::factory()->create([
            'company_id' => $company->id,
            'whatsapp_chat_id' => $whatsappChat->id,
            'type' => "text",
            'badge' => "input",
            'text' => $this->faker->text(),
            'status' => "unread",
        ]);

        WhatsappMessage::factory()->create([
            'company_id' => $company->id,
            'whatsapp_chat_id' => $whatsappChat->id,
            'type' => "text",
            'badge' => "input",
            'text' => $this->faker->text(),
            'status' => "unread",
        ]);

        WhatsappMessage::factory()->create([
            'company_id' => $company->id,
            'whatsapp_chat_id' => $whatsappChat->id,
            'type' => "text",
            'badge' => "output",
            'text' => $this->faker->text(),
            'status' => "unread",
        ]);

        $filters = [
            'status' => 'unread',
            'type' => 'text',
            'badge' => 'input',
            'sort' => 'created_at',
            'order' => 'desc',
            'rows' => 10,
            'page' => 1,
        ];

        $request = new Request($filters);

        $results = WhatsappMessageService::index(
            $request,
            $company->id,
            $whatsappChat->id
        );

        echo "Messages\n".json_encode($results)."\n";
        $this->assertIsObject($results);
        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
    }

    public function test_whatsapp_messages_show(): void
    {
        $company = Company::factory()->create([
            'name' => $this->faker->userName(),
            'email' => $this->faker->unique()->companyEmail(),
        ]);

        $application = Application::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'name' => $this->faker->userName(),
        ]);

        $whatsappAccount = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $this->faker->word(),
        ]);

        $whatsappNumber = WhatsappNumber::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'whatsapp_account_id' => $whatsappAccount->id,
            'name_visible' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->uuid(),
            'pin' => "123456",
        ]);

        $whatsappChat = WhatsappChat::factory()->create([
            "id" => $this->faker->uuid(),
            'whatsapp_number_id' => $whatsappNumber->id,
            'company_id' => $company->id,
            'from' => $this->faker->phoneNumber(),
        ]);

        $whatsappMessage = WhatsappMessage::factory()->create([
            'company_id' => $company->id,
            'whatsapp_chat_id' => $whatsappChat->id,
            'type' => "text",
            'badge' => "input",
            'text' => $this->faker->text(),
            'status' => "unread",
        ]);
        
        // Cuando el recurso no existe, debería lanzar una excepción
        // $this->expectException(\Exception::class);
        // $this->expectExceptionMessage("El mensaje seleccionado no existe");

        $result = WhatsappMessageService::show(
            $company->id, 
            //"455446545465", Usar un chat_id que no existe para probar la excepción 
            $whatsappChat->id,
            $whatsappMessage->id
        );

        echo "Show message\n".json_encode($result)."\n";
        $this->assertIsObject($result);
        $this->assertInstanceOf(WhatsappMessage::class, $result);
    }

    public function test_whatsapp_messages_store(): void
    {
        $company = Company::factory()->create([
            'name' => $this->faker->userName(),
            'email' => $this->faker->unique()->companyEmail(),
        ]);

        $application = Application::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'name' => $this->faker->userName(),
        ]);

        $whatsappAccount = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $this->faker->word(),
        ]);

        $whatsappNumber = WhatsappNumber::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'whatsapp_account_id' => $whatsappAccount->id,
            'name_visible' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->uuid(),
            'pin' => "123456",
        ]);

        $whatsappChat = WhatsappChat::factory()->create([
            "id" => $this->faker->uuid(),
            'whatsapp_number_id' => $whatsappNumber->id,
            'company_id' => $company->id,
            'from' => $this->faker->phoneNumber(),
        ]);

        $request = new Request([
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
        ]);

        $result = WhatsappMessageService::store($request, $company->id, $whatsappChat->id);

        echo "Store message\n".json_encode($result)."\n";
        $this->assertIsObject($result);
        $this->assertInstanceOf(WhatsappMessage::class, $result);
    }

    public function test_whatsapp_messages_update(): void
    {
        $company = Company::factory()->create([
            'name' => $this->faker->userName(),
            'email' => $this->faker->unique()->companyEmail(),
        ]);

        $application = Application::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'name' => $this->faker->userName(),
        ]);

        $whatsappAccount = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $this->faker->word(),
        ]);

        $whatsappNumber = WhatsappNumber::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'whatsapp_account_id' => $whatsappAccount->id,
            'name_visible' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->uuid(),
            'pin' => "123456",
        ]);

        $whatsappChat = WhatsappChat::factory()->create([
            "id" => $this->faker->uuid(),
            'whatsapp_number_id' => $whatsappNumber->id,
            'company_id' => $company->id,
            'from' => $this->faker->phoneNumber(),
        ]);

        $whatsappMessage = WhatsappMessage::factory()->create([
            'company_id' => $company->id,
            'whatsapp_chat_id' => $whatsappChat->id,
            'type' => "text",
            'badge' => "input",
            'text' => $this->faker->text(),
            'status' => "unread",
        ]);

        $request = new Request([
            "whatsapp_chat_id" => $whatsappChat->id,
            "type" => "text",
            "badge" => "input",
            "text" => $this->faker->text(),
            "status" => "unread"
        ]);

        // Cuando no existe el mensaje, debería lanzar una excepción
        // $this->expectException(\Exception::class);
        // $this->expectExceptionMessage("El mensaje seleccionado no existe para la empresa y chat especificados.");
        // $this->expectExceptionCode(400);

        // Actualizar el mensaje a leído
        $result = WhatsappMessageService::update($request, $company->id, $whatsappChat->id, $whatsappMessage->id);

        echo "Update message\n".json_encode($result)."\n";
        $this->assertIsInt($result);
    }

    public function test_whatsapp_messages_delete(): void
    {
        $company = Company::factory()->create([
            'name' => $this->faker->userName(),
            'email' => $this->faker->unique()->companyEmail(),
        ]);

        $application = Application::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'name' => $this->faker->userName(),
        ]);

        $whatsappAccount = WhatsappAccount::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'application_id' => $application->id,
            'name' => $this->faker->word(),
        ]);

        $whatsappNumber = WhatsappNumber::factory()->create([
            'id' => $this->faker->randomDigit(),
            'company_id' => $company->id,
            'whatsapp_account_id' => $whatsappAccount->id,
            'name_visible' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'api_key' => $this->faker->uuid(),
            'pin' => "123456",
        ]);

        $whatsappChat = WhatsappChat::factory()->create([
            "id" => $this->faker->uuid(),
            'whatsapp_number_id' => $whatsappNumber->id,
            'company_id' => $company->id,
            'from' => $this->faker->phoneNumber(),
        ]);

        $whatsappMessage = WhatsappMessage::factory()->create([
            'company_id' => $company->id,
            'whatsapp_chat_id' => $whatsappChat->id,
            'type' => "text",
            'badge' => "input",
            'text' => $this->faker->text(),
            'status' => "unread",
        ]);

        // Cuando no existe el mensaje, debería lanzar una excepción
        // $this->expectException(\Exception::class);
        // $this->expectExceptionMessage("El mensaje seleccionado no existe para la empresa y chat especificados.");
        // $this->expectExceptionCode(400);

        // Eliminar el mensaje
        WhatsappMessageService::delete($company->id, $whatsappChat->id, $whatsappMessage->id);

        echo "Delete message\n";
        $this->assertTrue(true);
    }
}
