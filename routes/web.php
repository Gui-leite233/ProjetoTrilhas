<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

Route::get('/', function () {
    return view('welcome');
});

Route::put('/create', function () {
    return view('curso.create');
});


Route::resource('/curso', 'App\Http\Controllers\CursoController');

Route::get('/cursos', [CursoController::class, 'store'])->name('curso.store');

Route::post('/cursos/create/', [CursoController::class, 'store'])->name('curso.store');
