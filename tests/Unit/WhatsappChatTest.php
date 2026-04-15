<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Application;
use App\Models\WhatsappAccount;
use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use App\Models\WhatsappNumber;
use App\Services\whatsapp_chats\WhatsappChatService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class WhatsappChatTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_whatsapp_chats_index_messages(): void
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

        $results = WhatsappChatService::messages(
            $request,
            $company->id,
            $whatsappChat->id
        );

        echo "Messages\n".json_encode($results)."\n";
        $this->assertIsObject($results);
        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
    }

    public function test_whatsapp_chats_count_messages(): void
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
        ];

        $request = new Request($filters);

        $results = WhatsappChatService::count(
            $request,
            $company->id,
            $whatsappChat->id
        );

        echo "Count messages\n".$results."\n";
        $this->assertIsNumeric($results);
    }

    public function test_whatsapp_chat_last_message(): void
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

        $result = WhatsappChatService::last(
            $company->id,
            $whatsappChat->id
        );

        echo "Last message\n".json_encode($result)."\n";
        $this->assertIsObject($result);
        $this->assertInstanceOf(WhatsappMessage::class, $result);
    }

    /**
     * Summary of test_index_whatsapp_chats
     * 
     * Responde con los chats de una compañia, paginado segun los filters pasados en la request
     * @return void
     */
    public function test_whatsapp_chats_index(): void
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

        WhatsappChat::factory()->create([
            "id" => $this->faker->uuid(),
            'whatsapp_number_id' => $whatsappNumber->id,
            'company_id' => $company->id,
            'from' => $this->faker->phoneNumber(),
        ]);

        WhatsappChat::factory()->create([
            "id" => $this->faker->uuid(),
            'whatsapp_number_id' => $whatsappNumber->id,
            'company_id' => $company->id,
            'from' => $this->faker->phoneNumber(),
        ]);

        // Aquí puedes agregar filtros específicos para la prueba
        $filters = [
            "whatsapp_number_id" => $whatsappNumber->id,
            "sort" => "created_at",
            "order" => "desc",
            "rows" => 10,
            "page" => 1,
        ];

        $request = new Request($filters);

        $results = WhatsappChatService::index(
            $request,
            $company->id
        );

        echo "Index chats\n".json_encode($results)."\n";
        $this->assertIsObject($results);
        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
    }

    /**
     * Summary of test_show_whatsapp_chat
     * 
     * Responde con un chat de whatsapp específico, según el id pasado como parámetro
     * @return void
     */
    public function test_whatsapp_chats_show(): void
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

        $result = WhatsappChatService::show(
            $company->id,
            $whatsappChat->id
        );

        echo "Show chat\n".json_encode($result)."\n";
        $this->assertJson($result);
        $this->assertInstanceOf(WhatsappChat::class, $result);
    }

    public function test_whatsapp_chats_create(): void
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

        // Aquí puedes agregar los datos que deseas crear
        $createData = [
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

        $request = new Request($createData);

        $result = WhatsappChatService::store(
            $request,
            $company->id
        );

        echo "Create chat\n".json_encode($result)."\n";
        $this->assertIsObject($result);
        $this->assertInstanceOf(WhatsappChat::class, $result);
    }

    /**
     * Summary of test_update_whatsapp_chat
     * 
     * Actualiza un chat de whatsapp específico, según el id pasado como parámetro y los datos de la request
     * @return void
     */
    public function test_whatsapp_chats_update(): void
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

        // Aquí puedes agregar los datos que deseas actualizar
        $updateData = [
            "status" => "active",
        ];

        $request = new Request($updateData);

        WhatsappChatService::update(
            $request,
            $company->id,
            $whatsappChat->id
        );

        $this->assertTrue(true);
    }

    /**
     * Summary of test_delete_whatsapp_chat
     * 
     * Elimina un chat de whatsapp específico, según el id pasado como parámetro
     * @return void
     */
    public function test_whatsapp_chats_delete(): void
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

        WhatsappChatService::delete(
            $company->id,
            $whatsappChat->id
        );

        // Verificar que el chat haya sido eliminado
        $deletedChat = WhatsappChat::find($whatsappChat->id);
        echo "Deleted chat\n".$deletedChat."\n";
        $this->assertNull($deletedChat);
    }
}
