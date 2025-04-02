<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Bolsa;
use App\Models\Curso;
use App\Models\Prova;
use App\Models\Tcc;
use App\Models\Projeto;
use App\Models\Resumo;
use Illuminate\Http\Request;

class SiteController extends Controller {
    
    public function getCursos() {

        $data = Curso::orderBy('nome')->get();
        return view('site.curso', compact('data'));
    }

    public function getProvas() {

        $data = Prova::orderBy('titulo')->get();
        return view('site.prova', compact('data'));
    }

    public function getTccs() {

        $data = Tcc::orderBy('titulo')->get();
        return view('site.tcc', compact('data'));
    }
    public function getBolsas() {

        $data = Bolsa::orderBy('titulo')->get();
        return view('site.bolsa', compact('data'));
    }

    public function getProjetos() {
        $data = Projeto::with([
            'users.curso',  // Load the direct curso relationship
            'users.aluno.curso'  // Load the curso through aluno relationship
        ])->orderBy('titulo')->get();
        
        return view('site.projeto', compact('data'));
    }

    public function getAlunos() {
        $data = Aluno::with(['usuario', 'curso'])->get();
        return view('site.aluno', ['data' => $data]);
    }
    public function getResumos() {
        $data = Resumo::orderBy('titulo')->get();
        return view('site.resumo', compact('data'));
    }
}