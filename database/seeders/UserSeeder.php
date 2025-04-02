<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Curso;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'nome' => 'Administrador',
            'email' => 'admin@exemplo.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'Admin')->first()->id,
            'is_admin' => true
        ]);

        //Para quando o site for ao ar
        /*User::create([
            'nome' => 'Administrador',
            'email' => 'gil.andrade@ifpr.edu.br',
            'password' => bcrypt('IFPR@2025#TI'),
            'role_id' => Role::where('name', 'Admin')->first()->id
        ]);
        User::create([
            'nome' => 'Administrador',
            'email' => 'gil.andrade@ifpr.edu.br',
            'password' => bcrypt('IFPR@2025#TI'),
            'role_id' => Role::where('name', 'Admin')->first()->id
        ]);
        
        */

        // Create Coordenador
        User::create([
            'nome' => 'Coordenador',
            'email' => 'coordenador@exemplo.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'Coordenador')->first()->id,
            'is_admin' => false
        ]);

        // Create Alunos
        User::create([
            'nome' => 'Aluno Teste',
            'email' => 'aluno@exemplo.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'Aluno')->first()->id,
            'curso_id' => Curso::where('nome', 'Meio Ambiente')->first()->id,
            'ano' => 1,
            'is_admin' => false
        ]);

        User::create([
            'nome' => 'Aluno Teste 2',
            'email' => 'aluno2@exemplo.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('name', 'Aluno')->first()->id,
            'curso_id' => Curso::where('nome', 'Informática')->first()->id,
            'ano' => 2,
            'is_admin' => false
        ]);
    }
}
