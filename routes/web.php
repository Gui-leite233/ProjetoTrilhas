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
    MailController,
    ResumoController,
};

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/test', function () {
    return view('/sobre/index');
})->name('sobre');

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/sobre', function() {
    return view('sobre.index');
})->name('sobre.index');

// Comment out or remove these since they're not currently implemented
// Route::get('/contato', 'ContatoController@index')->name('contato.index');
// Route::get('/cursos', 'CursosController@index')->name('cursos.index');
Route::get('/resumos', 'ResumosController@index')->name('resumos.index');
Route::get('/projetos', 'ProjetosController@index')->name('projetos.index');
Route::get('/provas', 'ProvasController@index')->name('provas.index');
Route::get('/bolsas', 'BolsasController@index')->name('bolsas.index');
Route::get('/semanas', 'SemanasController@index')->name('semanas.index');
Route::get('/tccs', 'TccsController@index')->name('tccs.index');

// Site routes - publicly accessible
Route::prefix('site')->name('site.')->group(function () {
    Route::controller(SiteController::class)->group(function () {
        Route::get('/curso', 'getCursos')->name('curso');
        Route::get('/prova', 'getProvas')->name('prova');
        Route::get('/tcc', 'getTccs')->name('tcc');
        Route::get('/bolsa', 'getBolsas')->name('bolsa');
        Route::get('/aluno', 'getAlunos')->name('aluno');
        Route::get('/projeto', 'getProjetos')->name('projeto');
        Route::get('/resumo', 'getResumos')->name('resumo');
    });

    // PDF view and download routes
    Route::get('/prova/view/{id}', [ProvaController::class, 'viewPdf'])->name('prova.viewPdf');
    Route::get('/prova/download/{id}', [ProvaController::class, 'downloadPdf'])->name('prova.downloadPdf');
    
    Route::get('/tcc/view/{id}', [TccController::class, 'viewPdf'])->name('tcc.viewPdf');
    Route::get('/tcc/download/{id}', [TccController::class, 'downloadPdf'])->name('tcc.downloadPdf');
    
    Route::get('/resumo/view/{id}', [ResumoController::class, 'viewPdf'])->name('resumo.viewPdf');
    Route::get('/resumo/download/{id}', [ResumoController::class, 'downloadPdf'])->name('resumo.download');
});

// Add unauthorized route
Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

// Add this new route before your other routes
Route::get('/admin/register', function () {
    return view('auth.register');
})->name('admin.register')->middleware('can:viewAdminItems,App\Models\User');

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

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->middleware(['guest'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])
        ->middleware(['guest'])
        ->name('register');
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Dashboard and Profile routes
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    
    Route::prefix('admin')->name('admin.')->group(function () {
        // Resources available to all authenticated users
        Route::resources([
            'tcc' => TccController::class,
            'prova' => ProvaController::class,
            'bolsa' => BolsaController::class,
            'curso' => CursoController::class,
            'aluno' => AlunoController::class,
            'projeto' => ProjetoController::class,
            'resumo' => ResumoController::class,
        ]);

        // Admin PDF routes
        Route::prefix('resumo')->name('resumo.')->group(function () {
            Route::get('viewPdf/{id}', [ResumoController::class, 'viewPdf'])->name('viewPdf');
            Route::get('download/{id}', [ResumoController::class, 'downloadPdf'])->name('download');
        });

        Route::prefix('tcc')->name('tcc.')->group(function () {
            Route::get('viewPdf/{id}', [TccController::class, 'viewPdf'])->name('viewPdf');
            Route::get('download/{id}', [TccController::class, 'downloadPdf'])->name('download');
        });

        Route::prefix('prova')->name('prova.')->group(function () {
            Route::get('viewPdf/{id}', [ProvaController::class, 'viewPdf'])->name('viewPdf');
            Route::get('download/{id}', [ProvaController::class, 'downloadPdf'])->name('download');
        });

        // Email routes
        Route::post('/send-email', [MailController::class, 'sendEmail'])->name('send.email');
        Route::post('/send-welcome-email/{user}', [MailController::class, 'sendWelcomeEmail'])->name('send.welcome');
    });

    // Profile routes
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
        Route::put('/password', 'updatePassword')->name('password.update');
    });

    // Add new admin register routes
    Route::get('admin/register', [RegisteredUserController::class, 'create'])
        ->middleware(['auth'])
        ->name('admin.register');

    Route::post('admin/register', [RegisteredUserController::class, 'store'])
        ->middleware(['auth'])
        ->name('admin.register.store');
});