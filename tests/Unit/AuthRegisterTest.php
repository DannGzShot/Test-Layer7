<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthRegisterTest extends TestCase
{
    use RefreshDatabase;
    
    public function it_registers_a_user_correctly()
    {
        $this->withoutMiddleware();

        $data = [
            'name' => 'Daniel',
            'email' => 'a@a.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->post('/register', $data);

        $response->assertRedirect('/admin/products');

        $this->assertDatabaseHas('users', [
            'email' => 'a@a.com',
        ]);

        $this->assertAuthenticated();
    }
}