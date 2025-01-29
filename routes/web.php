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
    ProjetoController
};

use Illuminate\Support\Facades\Route;

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

Route::controller(RegisteredUserController::class)->group(function () {
    Route::get('register', 'create')->name('register');
    Route::post('register', 'store');
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

    // Email Verification
    Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

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
        Route::get('download/{id}', [TccController::class, 'downloadPdf'])->name('downloadPdf');
    });

    Route::prefix('prova')->name('prova.')->group(function () {
        Route::get('viewPdf/{id}', [ProvaController::class, 'viewPdf'])->name('viewPdf');
        Route::get('download/{id}', [ProvaController::class, 'downloadPdf'])->name('download');
    });
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