<?php

namespace App\Http\Controllers;
use App\Models\Curso;
use App\Models\Prova;
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
    
}