<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Application;
use App\Models\Permission;
use App\Models\User;
use App\Models\VerifyToken;
use App\Models\WhatsappAccount;
use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use App\Models\WhatsappNumber;
use App\Models\WhatsappResponse;
use Illuminate\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create('es_MX');
        
        $abilities = [
            'applications.read', 
            'applications.write', 
            'applications.delete',
            'personal_access_tokens.read',
            'personal_access_tokens.write',
            'personal_access_tokens.delete',
            'companies.read',
            'companies.write',
            'companies.delete',
            'users.read',
            'users.write',
            'users.delete',
            'verify_tokens.read',
            'verify_tokens.write',
            'verify_tokens.delete',
            'whatsapp_accounts.read',
            'whatsapp_accounts.write',
            'whatsapp_accounts.delete',
            'whatsapp_numbers.read',
            'whatsapp_numbers.write',
            'whatsapp_numbers.delete',
            'whatsapp_chats.read',
            'whatsapp_chats.write',
            'whatsapp_chats.delete',
            'whatsapp_messages.read',
            'whatsapp_messages.write',
            'whatsapp_messages.delete',
        ];

        \DB::table('companies')->insert([
            [
                'id' => $faker->uuid(),
                'name' => $faker->company(),
                'email' => $faker->unique()->email()
            ],
            [
                'id' => $faker->uuid(),
                'name' => $faker->company(),
                'email' => $faker->unique()->email()
            ],
            [
                'id' => $faker->uuid(),
                'name' => $faker->company(),
                'email' => $faker->unique()->email()
            ],
            [
                'id' => $faker->uuid(),
                'name' => $faker->company(),
                'email' => $faker->unique()->email()
            ],
            [
                'id' => $faker->uuid(),
                'name' => $faker->company(),
                'email' => $faker->unique()->email()
            ]
        ]);

        $companies = Company::all();

        foreach($companies as $company) {
            \DB::table('users')->insert([
                [
                    'company_id' => $company->id,
                    'name' => $faker->firstName() . " " . $faker->lastName(),
                    'email' => $faker->unique()->email(),
                    'password' => 'admin'
                ],
                [
                    'company_id' => $company->id,
                    'name' => $faker->firstName() . " " . $faker->lastName(),
                    'email' => $faker->unique()->email(),
                    'password' => 'admin'
                ],
                [
                    'company_id' => $company->id,
                    'name' => $faker->firstName() . " " . $faker->lastName(),
                    'email' => $faker->unique()->email(),
                    'password' => 'admin'
                ],
                [
                    'company_id' => $company->id,
                    'name' => $faker->firstName() . " " . $faker->lastName(),
                    'email' => $faker->unique()->email(),
                    'password' => 'admin'
                ],
                [
                    'company_id' => $company->id,
                    'name' => $faker->firstName() . " " . $faker->lastName(),
                    'email' => $faker->unique()->email(),
                    'password' => 'admin'
                ]
            ]);

            $users = User::all();

            foreach($users as $user) {
                foreach ($abilities as $ability) {
                    \DB::table('permissions')->insert([
                        'user_id' => $user->id,
                        'ability' => $ability,
                    ]);
                }
            }

            \DB::table('applications')->insert([
                [
                    'id' => (string) $faker->randomNumber(9, true),
                    'company_id' => $company->id,
                    'name' => $faker->name()
                ],
                [
                    'id' => (string) $faker->randomNumber(9, true),
                    'company_id' => $company->id,
                    'name' => $faker->name()
                ]
            ]);

            $applications = Application::all();

            foreach($applications as $app) {
                VerifyToken::factory()->create([
                    'company_id' => $company->id,
                    'application_id' => $app->id,
                ]);

                $accounts = WhatsappAccount::factory()->create([
                   'id' => (string) $faker->randomNumber(9, true),
                    'company_id' => $company->id,
                    'application_id' => $app->id,
                    'name' => $faker->firstName,
                ]);

                foreach($accounts as $account) {
                    $numbers = WhatsappNumber::factory()->create([
                        'id' => (string) $faker->randomNumber(9, true),
                        'company_id' => $company->id,
                        'whatsapp_account_id' => $account->id,
                        'name_visible' => $faker->unique()->firstNameFemale(),
                        'phone_number' => $faker->phoneNumber(),
                        'api_key' => $faker->uuid(),
                        'pin' => $faker->randomNumber()
                    ]);

                    foreach($numbers as $number) {
                        $phoneNumber = str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->phoneNumber());
                        $id = "CHAT-$phoneNumber";

                        $chats = WhatsappChat::factory()->create([
                            "id" => $id,
                            'whatsapp_number_id' => $number->id,
                            'company_id' => $company->id,
                            'from' => $phoneNumber
                        ]);

                        foreach($chats as $chat) {
                            WhatsappMessage::factory()->create([
                                'company_id' => $company->id,
                                'whatsapp_chat_id' => $chat->id,
                                'type' => 'text',
                                'badge' => 'input',
                                'text' => $faker->text(),
                                'status' => 'unread',
                            ]);
                        }
                    }
                }
            }
        }
        
        // Application::factory()->count(20)->create();
        // WhatsappAccount::factory()->count(50)->create();
        // WhatsappNumber::factory()->count(100)->create();
        // VerifyToken::factory()->count(20)->create();
        // WhatsappResponse::factory()->count(10)->create();
        // WhatsappChat::factory()->count(500)->create();
        // WhatsappMessage::factory()->count(3000)->create();
    }
}
