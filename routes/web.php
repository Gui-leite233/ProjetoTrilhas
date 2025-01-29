<?php

// Auth Related Controllers
use App\Http\Controllers\Auth\{
    AuthenticatedSessionController,
    RegisteredUserController,
    PasswordResetLinkController,
    EmailVerificationNotificationController,
    VerifyEmailController,
    NewPasswordController
};

// Resource Controllers
use App\Http\Controllers\{
    ProfileController,
    CursoController,
    SiteController,
    ProvaController,
    TccController,
    BolsaController,
    AlunoController,
    ProjetoController,
    MailController
};

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('index');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::controller(AuthenticatedSessionController::class)->group(function () {
    Route::get('login', 'create')->name('login');
    Route::post('login', 'store');
    Route::post('logout', 'destroy')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Password Reset Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::controller(PasswordResetLinkController::class)->group(function () {
        Route::get('forgot-password', 'create')->name('password.request');
        Route::post('forgot-password', 'store')->name('password.email');
    });

    Route::controller(NewPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'create')->name('password.reset');
        Route::post('reset-password', 'store')->name('password.update');
    });

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Profile Management
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
        Route::put('/password', 'updatePassword')->name('password.update');
    });

    // Resource Routes
    Route::resources([
        'tcc' => TccController::class,
        'curso' => CursoController::class,
        'prova' => ProvaController::class,
        'bolsa' => BolsaController::class,
        'aluno' => AlunoController::class,
        'projeto' => ProjetoController::class,
    ]);

    // PDF Routes
    Route::prefix('tcc')->name('tcc.')->group(function () {
        Route::get('viewPdf/{id}', [TccController::class, 'viewPdf'])->name('viewPdf');
        Route::get('download/{id}', [TccController::class, 'downloadPdf'])->name('download');
    });

    Route::prefix('prova')->name('prova.')->group(function () {
        Route::get('viewPdf/{id}', [ProvaController::class, 'viewPdf'])->name('viewPdf');
        Route::get('download/{id}', [ProvaController::class, 'downloadPdf'])->name('download');
    });

    // Email Routes
    Route::post('/send-email', [MailController::class, 'sendEmail'])->name('send.email');
    Route::post('/send-welcome-email/{user}', [MailController::class, 'sendWelcomeEmail'])->name('send.welcome');
});

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
*/

Route::prefix('site')->name('site.')->group(function () {
    Route::controller(SiteController::class)->group(function () {
        Route::get('/curso', 'getCursos')->name('curso');
        Route::get('/prova', 'getProvas')->name('prova');
        Route::get('/tcc', 'getTccs')->name('tcc');
        Route::get('/bolsa', 'getBolsas')->name('bolsa');
        Route::get('/aluno', 'getAlunos')->name('aluno');
        Route::get('/projeto', 'getProjetos')->name('projeto');
    });
});