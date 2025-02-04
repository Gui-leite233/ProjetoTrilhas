<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    public function run(): void
    {
        $cursos = [
            [
                'nome' => 'Informática',
                'descricao' => 'Curso técnico em Informática com foco em desenvolvimento de sistemas e manutenção de computadores.',
                'link' => 'https://www.exemplo.com/informatica',
            ],
            [
                'nome' => 'Meio Ambiente',
                'descricao' => 'Curso técnico em Meio Ambiente focado em sustentabilidade e gestão ambiental.',
                'link' => 'https://www.exemplo.com/meio-ambiente',
            ],
            [
                'nome' => 'Mecânica',
                'descricao' => 'Curso técnico em Mecânica com ênfase em processos de fabricação e manutenção industrial.',
                'link' => 'https://www.exemplo.com/mecanica',
            ],
            [
                'nome' => 'Produção cultural',
                'descricao' => 'Curso técnico em Produção cultural com ênfase em processos de fabricação e manutenção industrial.',
                'link' => 'https://www.exemplo.com/Prod',
            ]
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }
    }
}
