<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::put('/create', function () {
    return view('curso.create');
});

Route::resource('/curso', 'App\Http\Controllers\CursoController');
require __DIR__.'/auth.php';
