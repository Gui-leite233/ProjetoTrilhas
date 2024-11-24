<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CursoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProvaController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('curso', CursoController::class);
Route::resource('prova', ProvaController::class);

Route::prefix('/site')->group(function() {
    Route::get('/curso', [SiteController::class, 'getCursos'])->name('site.curso');
    Route::get('/prova', [SiteController::class, 'getProvas'])->name('site.prova');
});



//require __DIR__.'/auth.php';