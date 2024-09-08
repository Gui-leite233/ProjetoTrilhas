<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('curso.index');
});

Route::resource('/curso', 'App\Http\Controllers\CursoController');

