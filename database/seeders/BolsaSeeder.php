<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bolsa;
use App\Models\Curso;

class BolsaSeeder extends Seeder
{
    public function run(): void
    {
        $bolsas = [
            [
                'titulo' => 'Bolsa de Estudos 1',
                'descricao' => 'Descrição da Bolsa de Estudos 1',
                'curso_id' => Curso::where('nome', 'Informática')->first()->id,
                'ativo' => true,
            ],
            [
                'titulo' => 'Bolsa de Estudos 2',
                'descricao' => 'Descrição da Bolsa de Estudos 2',
                'curso_id' => Curso::where('nome', 'Meio Ambiente')->first()->id,
                'ativo' => true,
            ],
        ];

        foreach ($bolsas as $bolsa) {
            Bolsa::create($bolsa);
        }
    }
}
