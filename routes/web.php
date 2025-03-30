<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    AuthenticatedSessionController,
    RegisteredUserController,
    PasswordResetLinkController,
    NewPasswordController,
    EmailVerificationPromptController,
    EmailVerificationNotificationController,
    VerifyEmailController,
};
use App\Http\Controllers\{
    ProfileController,
    CursoController,
    SiteController,
    ProvaController,
    TccController,
    BolsaController,
    AlunoController,
    ProjetoController,
    SendMailController,
    ResumoController,
    AdminController,
    UnauthorizedController,
    MailController,
    OAuthController,
    UserController
};

Route::get('/unauthorized', UnauthorizedController::class)->name('unauthorized');
Route::get('/auth/google', [OAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/oauth2callback', [OAuthController::class, 'handleGoogleCallback']);

Route::view('/', 'index')->name('home');
Route::view('/sobre', 'sobre.index')->name('sobre');
Route::view('/contato', 'contato.index')->name('contato');
Route::post('/send-contact', [MailController::class, 'sendEmail'])->name('contact.send');
Route::get('/resumos', [ResumoController::class, 'index'])->name('resumo.index');
Route::get('/projetos', [ProjetoController::class, 'index'])->name('projeto.index');
Route::get('/provas', [ProvaController::class, 'index'])->name('prova.index');
Route::get('/bolsas', [BolsaController::class, 'index'])->name('bolsa.index');
Route::get('/semanas', [SiteController::class, 'semanas'])->name('semana.index');
Route::get('/tccs', [TccController::class, 'index'])->name('tcc.index');
Route::get('/cursos', [CursoController::class, 'index'])->name('curso.index');

Route::name('site.')->prefix('site')->group(function () {
    Route::controller(SiteController::class)->group(function () {
        Route::get('/curso', 'getCursos')->name('curso');
        Route::get('/prova', 'getProvas')->name('prova');
        Route::get('/tcc', 'getTccs')->name('tcc');
        Route::get('/bolsa', 'getBolsas')->name('bolsa');
        Route::get('/aluno', 'getAlunos')->name('aluno');
        Route::get('/projeto', 'getProjetos')->name('projeto');
        Route::get('/resumo', 'getResumos')->name('resumo');
    });

    Route::prefix('prova')->name('prova.')->group(function () {
        Route::get('view/{id}', [ProvaController::class, 'viewPdf'])->name('viewPdf');
        Route::get('download/{id}', [ProvaController::class, 'downloadPdf'])->name('download');
    });

    Route::prefix('tcc')->name('tcc.')->group(function () {
        Route::get('view/{id}', [TccController::class, 'viewPdf'])->name('viewPdf');
        Route::get('download/{id}', [TccController::class, 'downloadPdf'])->name('download');
    });

    Route::prefix('resumo')->name('resumo.')->group(function () {
        Route::get('view/{id}', [ResumoController::class, 'viewPdf'])->name('viewPdf');
        Route::get('download/{id}', [ResumoController::class, 'downloadPdf'])->name('download');
    });
});

Route::middleware('guest')->group(function () {
    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store');
    });

    Route::controller(PasswordResetLinkController::class)->group(function () {
        Route::get('forgot-password', 'create')->name('password.request');
        Route::post('forgot-password', 'store')->name('password.email');
    });

    Route::controller(NewPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'create')->name('password.reset');
        Route::post('reset-password', 'store')->name('password.update');
    });

    Route::controller(RegisteredUserController::class)->group(function () {
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
        Route::put('/password', 'updatePassword')->name('password.update');
    });

    Route::post('/send-email', [SendMailController::class, 'send'])->name('send.email');
    Route::get('/email-verified', function () {
        return view('auth.verification-success');
    })->name('verification-success');
    Route::resource('users', UserController::class);
});

Route::resource('resumo', ResumoController::class);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return app(\App\MoonShine\Pages\Dashboard::class);
        })->name('moonshine.index');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
        Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    });

    Route::resources([
        'tcc' => TccController::class,
        'prova' => ProvaController::class,
        'bolsa' => BolsaController::class,
        'curso' => CursoController::class,
        'aluno' => AlunoController::class,
        'projeto' => ProjetoController::class
    ], ['except' => ['index']]);

    Route::get('/register/coordinator', [RegisteredUserController::class, 'createCoordinator'])->name('coordinator.register');
    Route::post('/register/coordinator', [RegisteredUserController::class, 'storeCoordinator'])->name('coordinator.store');
    Route::get('/register/admin', [RegisteredUserController::class, 'createAdmin'])->name('admin.register');
    Route::post('/register/admin', [RegisteredUserController::class, 'storeAdmin'])->name('register.admin.store');
    Route::get('/register/admin/confirm', [RegisteredUserController::class, 'confirmAdmin']);
});





