<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\SiteController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('curso', CursoController::class);

Route::prefix('/site')->group(function() {
    Route::get('/curso', [SiteController::class, 'getCursos'])->name('site.curso');
});


require __DIR__.'/auth.php';