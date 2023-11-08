<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function testSuccessLogin()
    {
        // $user = User::create([
        //     'name' => 'Italo Donoso',
        //     'email' => '',
        //     'role' => 1,
        //     'password' => bcrypt('mari0password')
        // ]);

        $response = $this->post('login', [
            'email' => 'italo.donoso@ucn.cl',
            'password' => 'Turjoy91',
        ]);

        $response->assertStatus(302); // Verifica el código de estado de la respuesta (redirección)
        $response->assertRedirect('dashboard'); // Verifica que se redirija a la página de dashboard
    }
}
