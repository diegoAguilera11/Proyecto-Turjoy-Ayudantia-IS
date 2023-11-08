<?php

namespace Tests\Unit;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testFailedRegister()
    {
        $userData = [
            'name' => 'd',
            'email' => 'diego',
            'password' => 'admin',
        ];

        // Registro con campos invalidos
        $response = $this->post('/register', $userData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name',
            'email',
            'password',
        ]);
    }
}
