<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CursoController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('curso', CursoController::class);
Route::prefix('/site')->group(function() {
    Route::get('/curso', [SiteController::class, 'getCursos'])->name('site.curso');
});
//Route::post('/curso/create', [CursoController::class, 'store'])->name('curso.store');
//Route::resource('/curso', 'App\Http\Controllers\CursoController');
require __DIR__.'/auth.php';
