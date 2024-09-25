<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class SiteController extends Controller {
    
    public function getCursos() {

        $data = Curso::orderBy('data')->get();
        return view('site.curso', compact('data'));
    }

    
}
