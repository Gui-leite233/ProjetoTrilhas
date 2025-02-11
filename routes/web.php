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

// Remove or comment out this route
// Route::get('/test', function () {
//     return view('/sobre/index');
// })->name('sobre');

Route::get('/', function () {
    return view('index');
})->name('home');

// Update this route to point to the correct view
Route::get('/sobre', function () {
    return view('sobre.index');
})->name('sobre');

Route::get('/contato', function () {
    return view('contato');
})->name('contato');

// Comment out or remove these since they're not currently implemented
// Route::get('/contato', 'ContatoController@index')->name('contato.index');
// Route::get('/cursos', 'CursosController@index')->name('cursos.index');
Route::get('/resumos', 'ResumosController@index')->name('resumos.index');
Route::get('/projetos', 'ProjetosController@index')->name('projetos.index');
Route::get('/provas', 'ProvasController@index')->name('provas.index');
Route::get('/bolsas', 'BolsasController@index')->name('bolsas.index');
Route::get('/semanas', 'SemanasController@index')->name('semanas.index');
Route::get('/tccs', 'TccsController@index')->name('tccs.index');

// Add the contact route
Route::get('/contato', [App\Http\Controllers\ContatoController::class, 'index'])->name('contato');

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
    Route::get('/prova/download/{id}', [ProvaController::class, 'downloadPdf'])->name('prova.download');
    
    Route::get('/tcc/view/{id}', [TccController::class, 'viewPdf'])->name('tcc.viewPdf');
    Route::get('/tcc/download/{id}', [TccController::class, 'downloadPdf'])->name('tcc.downloadPdf');
    
    Route::get('/resumo/view/{id}', [ResumoController::class, 'viewPdf'])->name('resumo.viewPdf');
    Route::get('/resumo/download/{id}', [ResumoController::class, 'downloadPdf'])->name('resumo.download');
});

// Add unauthorized route
Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Create an admin middleware group
Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/register', [RegisteredUserController::class, 'createAdmin'])
            ->name('admin.register');
        
        Route::post('/admin/register', [RegisteredUserController::class, 'storeAdmin'])
            ->name('admin.register.store');
    });
});

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

// Public routes for resource index pages
Route::get('/curso', [CursoController::class, 'index'])->name('curso.index');
Route::get('/prova', [ProvaController::class, 'index'])->name('prova.index');
Route::get('/tcc', [TccController::class, 'index'])->name('tcc.index');
Route::get('/bolsa', [BolsaController::class, 'index'])->name('bolsa.index');
Route::get('/aluno', [AlunoController::class, 'index'])->name('aluno.index');
Route::get('/projeto', [ProjetoController::class, 'index'])->name('projeto.index');  // Moved here
Route::get('/resumo', [ResumoController::class, 'index'])->name('resumo.index');

Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', 'edit')->name('edit');
    Route::patch('/', 'update')->name('update');
    Route::delete('/', 'destroy')->name('destroy');
    Route::put('/password', 'updatePassword')->name('password.update');
});

// Protected routes for administrative actions
Route::middleware(['auth'])->group(function () {
    // Resources except index
    Route::resources([
        'tcc' => TccController::class,
        'prova' => ProvaController::class,
        'bolsa' => BolsaController::class,
        'curso' => CursoController::class,
        'aluno' => AlunoController::class,
        'projeto' => ProjetoController::class,
        'resumo' => ResumoController::class,
    ], ['except' => ['index']]);
    
    // PDF routes
    Route::prefix('resumo')->name('resumo.')->group(function () {
        Route::get('viewPdf/{id}', [ResumoController::class, 'viewPdf'])->name('viewPdf');
        Route::get('download/{id}', [ResumoController::class, 'downloadPdf'])->name('download');
    });

    Route::prefix('tcc')->name('tcc.')->group(function () {
        Route::get('viewPdf/{id}', [TccController::class, 'viewPdf'])->name('viewPdf');
        Route::get('download/{id}', [TccController::class, 'downloadPdf'])->name('downloadPdf');
    });

    Route::prefix('prova')->name('prova.')->group(function () {
        Route::get('viewPdf/{id}', [ProvaController::class, 'viewPdf'])->name('viewPdf');
        Route::get('download/{id}', [ProvaController::class, 'downloadPdf'])->name('downloadPdf');
    });

    // Email routes
    Route::post('/send-email', [MailController::class, 'sendEmail'])->name('send.email');
    Route::post('/send-welcome-email/{user}', [MailController::class, 'sendWelcomeEmail'])->name('send.welcome');
});
