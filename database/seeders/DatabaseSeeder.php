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
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $faker = Factory::create('es_MX');

        // \DB::table('companies')->insert([
        //     [
        //         'id' => $faker->unique()->uuid(),
        //         'name' => $faker->company(),
        //         'email' => $faker->unique()->email()
        //     ],
        //     [
        //         'id' => $faker->unique()->uuid(),
        //         'name' => $faker->company(),
        //         'email' => $faker->unique()->email()
        //     ],
        //     [
        //         'id' => $faker->unique()->uuid(),
        //         'name' => $faker->company(),
        //         'email' => $faker->unique()->email()
        //     ],
        //     [
        //         'id' => $faker->unique()->uuid(),
        //         'name' => $faker->company(),
        //         'email' => $faker->unique()->email()
        //     ],
        //     [
        //         'id' => $faker->unique()->uuid(),
        //         'name' => $faker->company(),
        //         'email' => $faker->unique()->email()
        //     ]
        // ]);

        // $companies = Company::all();

        // foreach($companies as $company) {
        //     \DB::table('users')->insert([
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $company->id,
        //             'name' => $faker->firstName() . " " . $faker->lastName(),
        //             'email' => $faker->unique()->email(),
        //             'password' => Hash::make('admin')
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $company->id,
        //             'name' => $faker->firstName() . " " . $faker->lastName(),
        //             'email' => $faker->unique()->email(),
        //             'password' => Hash::make('admin')
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $company->id,
        //             'name' => $faker->firstName() . " " . $faker->lastName(),
        //             'email' => $faker->unique()->email(),
        //             'password' => Hash::make('admin')
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $company->id,
        //             'name' => $faker->firstName() . " " . $faker->lastName(),
        //             'email' => $faker->unique()->email(),
        //             'password' => Hash::make('admin')
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $company->id,
        //             'name' => $faker->firstName() . " " . $faker->lastName(),
        //             'email' => $faker->unique()->email(),
        //             'password' => Hash::make('admin')
        //         ]
        //     ]);

        //     \DB::table('applications')->insert([
        //         [
        //             'id' => (string) $faker->randomNumber(9, true),
        //             'company_id' => $company->id,
        //             'name' => $faker->name()
        //         ],
        //         [
        //             'id' => (string) $faker->randomNumber(9, true),
        //             'company_id' => $company->id,
        //             'name' => $faker->name()
        //         ]
        //     ]);
        // }

        // $users = User::all();

        // foreach($users as $user) {
        //     \DB::table('permissions')->insert([
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'applications.read',
        //         ],
        //         [ 
        //             'user_id' => $user->id,
        //             'ability' => 'applications.write',
        //         ],
        //         [ 
        //             'user_id' => $user->id,
        //             'ability' => 'applications.delete',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'personal_access_tokens.read',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'personal_access_tokens.write',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'personal_access_tokens.delete',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'companies.read',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'companies.write',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'companies.delete',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'users.read',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'users.write',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'users.delete',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'verify_tokens.read',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'verify_tokens.write',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'verify_tokens.delete',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_accounts.read',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_accounts.write',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_accounts.delete',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_numbers.read',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_numbers.write',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_numbers.delete',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_chats.read',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_chats.write',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_chats.delete',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_messages.read',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_messages.write',
        //         ],
        //         [
        //             'user_id' => $user->id,
        //             'ability' => 'whatsapp_messages.delete',
        //         ],
        //     ]);
        // }

        // $applications = Application::all();

        // foreach($applications as $app) {
        //     \DB::table('verify_tokens')->insert([
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $app->company_id,
        //             'application_id' => $app->id,
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $app->company_id,
        //             'application_id' => $app->id,
        //         ]
        //     ]);

        //     \DB::table('whatsapp_accounts')->insert([
        //         [
        //             'id' => (string) $faker->randomNumber(9, true),
        //             'company_id' => $app->company_id,
        //             'application_id' => $app->id,
        //             'name' => $faker->firstName,
        //         ],
        //         [
        //             'id' => (string) $faker->randomNumber(9, true),
        //             'company_id' => $app->company_id,
        //             'application_id' => $app->id,
        //             'name' => $faker->firstName,
        //         ]
        //     ]); 
        // }

        // $accounts = WhatsappAccount::all();

        // foreach($accounts as $account) {
        //     \DB::table('whatsapp_numbers')->insert([
        //         [
        //             'id' => (string) $faker->randomNumber(9, true),
        //             'company_id' => $account->company_id,
        //             'whatsapp_account_id' => $account->id,
        //             'name_visible' => $faker->unique()->firstNameFemale(),
        //             'phone_number' => $faker->phoneNumber(),
        //             'api_key' => $faker->unique()->uuid(),
        //             'pin' => $faker->randomNumber()
        //         ],
        //         [
        //             'id' => (string) $faker->randomNumber(9, true),
        //             'company_id' => $account->company_id,
        //             'whatsapp_account_id' => $account->id,
        //             'name_visible' => $faker->unique()->firstNameFemale(),
        //             'phone_number' => $faker->phoneNumber(),
        //             'api_key' => $faker->unique()->uuid(),
        //             'pin' => $faker->randomNumber()
        //         ]
        //     ]);
        // }

        // $numbers = WhatsappNumber::all();

        // foreach($numbers as $number) {
        //     \DB::table('whatsapp_chats')->insert([
        //         [
        //             "id" => "CHAT-".str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber()),
        //             'whatsapp_number_id' => $number->id,
        //             'company_id' => $number->company_id,
        //             'from' => str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber())
        //         ],
        //         [
        //             "id" => "CHAT-".str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber()),
        //             'whatsapp_number_id' => $number->id,
        //             'company_id' => $number->company_id,
        //             'from' => str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber())
        //         ],
        //         [
        //             "id" => "CHAT-".str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber()),
        //             'whatsapp_number_id' => $number->id,
        //             'company_id' => $number->company_id,
        //             'from' => str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber())
        //         ],
        //         [
        //             "id" => "CHAT-".str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber()),
        //             'whatsapp_number_id' => $number->id,
        //             'company_id' => $number->company_id,
        //             'from' => str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber())
        //         ],
        //         [
        //             "id" => "CHAT-".str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber()),
        //             'whatsapp_number_id' => $number->id,
        //             'company_id' => $number->company_id,
        //             'from' => str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber())
        //         ],
        //         [
        //             "id" => "CHAT-".str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber()),
        //             'whatsapp_number_id' => $number->id,
        //             'company_id' => $number->company_id,
        //             'from' => str_ireplace(['+', ' ', '-', '.', '(', ')', ','], '', $faker->unique()->phoneNumber())
        //         ]
        //     ]);
        // }

        // $chats = WhatsappChat::all();

        // foreach($chats as $chat) {
        //     \DB::table('whatsapp_messages')->insert([
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $chat->company_id,
        //             'whatsapp_chat_id' => $chat->id,
        //             'type' => 'text',
        //             'badge' => 'input',
        //             'text' => $faker->text(),
        //             'status' => 'read',
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $chat->company_id,
        //             'whatsapp_chat_id' => $chat->id,
        //             'type' => 'text',
        //             'badge' => 'output',
        //             'text' => $faker->text(),
        //             'status' => 'read',
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $chat->company_id,
        //             'whatsapp_chat_id' => $chat->id,
        //             'type' => 'text',
        //             'badge' => 'input',
        //             'text' => $faker->text(),
        //             'status' => 'read',
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $chat->company_id,
        //             'whatsapp_chat_id' => $chat->id,
        //             'type' => 'text',
        //             'badge' => 'input',
        //             'text' => $faker->text(),
        //             'status' => 'read',
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $chat->company_id,
        //             'whatsapp_chat_id' => $chat->id,
        //             'type' => 'text',
        //             'badge' => 'output',
        //             'text' => $faker->text(),
        //             'status' => 'read',
        //         ],
        //         [
        //             'id' => $faker->unique()->uuid(),
        //             'company_id' => $chat->company_id,
        //             'whatsapp_chat_id' => $chat->id,
        //             'type' => 'text',
        //             'badge' => 'input',
        //             'text' => $faker->text(),
        //             'status' => 'unread',
        //         ],
        //     ]);
        // }
        
        // Application::factory()->count(20)->create();
        // WhatsappAccount::factory()->count(50)->create();
        // WhatsappNumber::factory()->count(100)->create();
        // VerifyToken::factory()->count(20)->create();
        // WhatsappResponse::factory()->count(10)->create();
        // WhatsappChat::factory()->count(500)->create();
        // WhatsappMessage::factory()->count(3000)->create();
    }
}
