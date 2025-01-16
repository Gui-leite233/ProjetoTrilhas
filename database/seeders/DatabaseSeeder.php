<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // Check if roles exist and get aluno role ID
        $alunoRole = \App\Models\Role::where('name', 'aluno')->first();
        
        if ($alunoRole) {
            // Create a test user with aluno role
            $user = \App\Models\User::create([
                'nome' => 'Test Aluno',
                'email' => 'aluno@test.com',
                'password' => bcrypt('password'),
                'role_id' => $alunoRole->id
            ]);

            // Create corresponding Aluno record
            \App\Models\Aluno::create([
                'user_id' => $user->id,
                'ano' => '2023'
                // Add other required fields
            ]);
        }
    }
}
