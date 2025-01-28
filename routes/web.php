<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProvaController;
use App\Http\Controllers\TccController;
use App\Http\Controllers\BolsaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\NewPasswordController;

// Public routes
Route::get('/', function () {
    return view('index');
})->name('index');

// Authentication Routes
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Registration Routes
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Password Reset Routes
Route::middleware('guest')->group(function () {
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::resource('tcc', TccController::class);
});




Route::resource('curso', CursoController::class);
Route::resource('prova', ProvaController::class);
Route::resource('bolsa', BolsaController::class);
Route::resource('aluno', AlunoController::class);
Route::resource('projeto', ProjetoController::class);

// PDF routes
Route::get('/tcc/viewPdf/{id}', [TccController::class, 'viewPdf'])->name('tcc.viewPdf');
Route::get('/tcc/download/{id}', [TccController::class, 'downloadPdf'])->name('tcc.downloadPdf');
Route::get('/prova/viewPdf/{id}', [ProvaController::class, 'viewPdf'])->name('prova.viewPdf');
Route::get('/prova/download/{id}', [ProvaController::class, 'downloadPdf'])->name('prova.download');

// Site routes
Route::prefix('/site')->group(function () {
    Route::get('/curso', [SiteController::class, 'getCursos'])->name('site.curso');
    Route::get('/prova', [SiteController::class, 'getProvas'])->name('site.prova');
    Route::get('/tcc', [SiteController::class, 'getTccs'])->name('site.tcc');
    Route::get('/bolsa', [SiteController::class, 'getBolsas'])->name('site.bolsa');
    Route::get('/aluno', [SiteController::class, 'getAlunos'])->name('site.aluno');
    Route::get('/projeto', [SiteController::class, 'getProjetos'])->name('site.projeto');
});


