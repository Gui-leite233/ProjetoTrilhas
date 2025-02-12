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
                'link' => 'https://ifpr.edu.br/paranagua/nossos-cursos/ensino-medio-integrado/tecnico-em-manutencao-e-suporte-em-informatica/sobre-o-curso/',
            ],
            [
                'nome' => 'Meio Ambiente',
                'descricao' => 'Curso técnico em Meio Ambiente focado em sustentabilidade e gestão ambiental.',
                'link' => 'https://ifpr.edu.br/paranagua/nossos-cursos/ensino-medio-integrado/tecnico-em-meio-ambiente/',
            ],
            [
                'nome' => 'Mecânica',
                'descricao' => 'Curso técnico em Mecânica com ênfase em processos de fabricação e manutenção industrial.',
                'link' => 'https://ifpr.edu.br/paranagua/nossos-cursos/ensino-medio-integrado/mecanica-e-eletromecanica/sobre-o-curso/',
            ],
            [
                'nome' => 'Produção cultural',
                'descricao' => 'Curso técnico em Produção cultural com ênfase em processos de fabricação e manutenção industrial.',
                'link' => 'https://ifpr.edu.br/paranagua/nossos-cursos/ensino-medio-integrado/tecnico-em-producao-cultural/sobre-o-curso/',
            ],
            [
                'nome' => 'Tecnologia em Análise e Desenvolvimento de Sistemas',
                'descricao' => 'Curso técnico em Produção cultural com ênfase em processos de fabricação e manutenção industrial.',
                'link' => 'https://ifpr.edu.br/paranagua/nossos-cursos/ensino-superior/tecnologia-em-analise-de-sistemas/sobre-o-curso/',
            ]
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }
    }
}
