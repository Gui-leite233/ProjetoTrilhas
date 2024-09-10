<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('curso.index');
});

Route::get('/create', function () {
    return view('curso.create');
});


Route::resource('/curso', 'App\Http\Controllers\CursoController');

