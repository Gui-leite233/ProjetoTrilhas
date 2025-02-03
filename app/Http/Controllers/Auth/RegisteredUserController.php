<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Curso;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Http\Controllers\MailController;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Allow both guests and admin users to access registration
        if (!auth()->check() || (auth()->check() && auth()->user()->role_id === 1)) {
            $roles = Role::where('id', '!=', 1)->get(); // Filter out admin role (ID 1)
            $cursos = Curso::all();
            return view('auth.register', compact('roles', 'cursos'));
        }
        
        return redirect()->route('unauthorized');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Allow both guests and admin users to create new users
        if (!auth()->check() || (auth()->check() && auth()->user()->role_id === 1)) {
            try {
                \Log::info('Registration attempt with data:', $request->all());

                $validated = $request->validate([
                    'nome' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'confirmed'],
                    'role_id' => ['required', 'exists:roles,id'],
                    'curso_id' => ['nullable', 'exists:cursos,id'],
                    'ano' => ['nullable', 'integer', 'min:1', 'max:5'],
                ]);

                $userData = [
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => $request->role_id
                ];

                // Only add curso_id and ano if role_id is 3 (student)
                if ($request->role_id == 3) {
                    $userData['curso_id'] = $request->curso_id;
                    $userData['ano'] = $request->ano;
                }

                \Log::info('Creating user with data:', array_merge($userData, ['password' => '[hidden]']));

                $user = User::create($userData);

                \Log::info('User created successfully:', ['user_id' => $user->id]);

                // Send welcome email using the named route
                try {
                    $response = app('router')->toRoute('send.welcome', ['user' => $user]);
                    \Log::info('Welcome email sent successfully');
                } catch (\Exception $e) {
                    \Log::error('Failed to send welcome email:', ['error' => $e->getMessage()]);
                }

                if (!auth()->check()) {
                    Auth::login($user);
                    return redirect()->route('dashboard');
                }

                return redirect()->route('index')->with('success', 'Usuário criado com sucesso!');

            } catch (\Exception $e) {
                \Log::error('Registration failed:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'request_data' => $request->except(['password', 'password_confirmation'])
                ]);

                return back()
                    ->withInput($request->except(['password', 'password_confirmation']))
                    ->withErrors(['error' => 'Erro no registro. Por favor, tente novamente.']);
            }
        }

        return redirect()->route('unauthorized');
    }
}
