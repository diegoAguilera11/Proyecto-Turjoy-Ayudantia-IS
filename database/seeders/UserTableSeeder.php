<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear nuestros usuarios
        User::create([
            'name' => "Italo Donoso",
            'email' => "italo.donoso@ucn.cl",
            'password' => Hash::make("Turjoy91"),
            'role' => "Administrator"
        ]);
    }
}
