<?php

namespace Tests\Unit;

use App\Services\authentication\AuthenticationService;
use Hash;
use App\Models\Company;
use App\Models\User;
use App\Services\auth\LoginService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic unit test example.
     */
    public function test_login_success(): void
    {
        $company = Company::factory()->create([
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $user = User::factory()->create([
            'company_id' => $company->id,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'admin0123',
        ]);
        
        $request = new Request([
            'email' => $user->email,
            'password' => 'admin0123',
        ]);
        
        $results = AuthenticationService::login($request);

        echo "Login successful: " . json_encode($results) . "\n";

        $this->assertIsObject($results);
        $this->assertInstanceOf(User::class, $results);
    }

    public function test_logout_success(): void
    {
        $company = Company::factory()->create([
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $user = User::factory()->create([
            'company_id' => $company->id,
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'admin0123',
        ]);

        $request = new Request([
            'user_id' => $user->id,
            'company_id' => $company->id,
        ]);

        AuthenticationService::logout($request, $company->id, $user->id);
        $this->assertTrue(true);
    }
}
