<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Application;
use App\Models\User;
use App\Models\VerifyToken;
use App\Models\WhatsappAccount;
use App\Models\WhatsappChat;
use App\Models\WhatsappMessage;
use App\Models\WhatsappNumber;
use App\Models\WhatsappResponse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory()->count(10)->create();
        User::factory()->count(10)->create();
        Application::factory()->count(1)->create();
        WhatsappAccount::factory()->count(1)->create();
        WhatsappNumber::factory()->count(1)->create();
        VerifyToken::factory()->count(1)->create();
        WhatsappResponse::factory()->count(1)->create();
        WhatsappChat::factory()->count(10)->create();
        WhatsappMessage::factory()->count(100)->create();
    }
}
