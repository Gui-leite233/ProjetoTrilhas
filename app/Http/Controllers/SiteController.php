<?php

namespace App\Http\Controllers;

use App\Models\Bolsa;
use App\Models\Curso;
use App\Models\Prova;
use App\Models\Tcc;
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
    
}