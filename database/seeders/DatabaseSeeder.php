<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Application;
use App\Models\VerifyToken;
use App\Models\WhatsappAccount;
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
        Company::factory()->count(1)->create();
        Application::factory()->count(1)->create();
        WhatsappAccount::factory()->count(1)->create();
        WhatsappNumber::factory()->count(1)->create();
        VerifyToken::factory()->count(1)->create();
        WhatsappResponse::factory()->count(1)->create();
    }
}
