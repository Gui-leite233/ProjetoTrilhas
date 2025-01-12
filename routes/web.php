<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProvaController;
use App\Http\Controllers\TccController;
use App\Http\Controllers\BolsaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProjetoController;



Route::get('/', function () {
    return view('index');
})->name('index');


Route::resource('curso', CursoController::class);
Route::resource('prova', ProvaController::class);
Route::resource('tcc', TccController::class);
Route::resource('bolsa', BolsaController::class);
Route::resource('aluno', AlunoController::class);
Route::resource('projeto', ProjetoController::class);

Route::get('/tcc/viewPdf/{id}', [TccController::class, 'viewPdf'])->name('tcc.viewPdf');
Route::get('/prova/viewPdf/{id}', [ProvaController::class, 'viewPdf'])->name('prova.viewPdf');

Route::prefix('/site')->group(function () {
    Route::get('/curso', [SiteController::class, 'getCursos'])->name('site.curso');
    Route::get('/prova', [SiteController::class, 'getProvas'])->name('site.prova');
    Route::get('/tcc', [SiteController::class, 'getTccs'])->name('site.tcc');
    Route::get('/bolsa', [SiteController::class, 'getBolsas'])->name('site.bolsa');
    Route::get('/aluno', [SiteController::class, 'getAlunos'])->name('site.aluno');
    Route::get('/projeto', [SiteController::class, 'getProjetos'])->name('site.projeto');
});
require __DIR__.'/auth.php';
