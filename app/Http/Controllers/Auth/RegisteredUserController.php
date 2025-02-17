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
        if (!auth()->check() || (auth()->check() && auth()->user()->is_admin === true)) {
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
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['sometimes', 'required', 'exists:roles,id'],
            'curso_id' => ['required_if:role_id,3'],
            'ano' => ['required_if:role_id,3'],
        ]);

        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id ?? 3, // Default to student (3) if not specified
            'curso_id' => $request->curso_id,
            'ano' => $request->ano,
        ]);

        event(new Registered($user));

        Auth::login($user); // Log the user in immediately after registration

        return redirect()->route('verification.notice')
            ->with('status', 'Please verify your email address to continue.');
    }

    /**
     * Display the admin registration view.
     */
    public function createAdmin(): View
    {
        $roles = Role::all();
        $cursos = Curso::all();
        return view('auth.admin-register', compact('roles', 'cursos'));
    }

    /**
     * Display the coordinator registration view.
     */
    public function createCoordinator(): View
    {
        // Ensure only admin can access this
        if (!auth()->user()->role_id === 1) {
            return redirect()->route('unauthorized');
        }
        
        return view('auth.coordinator-register');
    }

    /**
     * Handle an incoming coordinator registration request.
     */
    public function storeCoordinator(Request $request): RedirectResponse
    {
        // Ensure only admin can perform this action
        if (!auth()->user()->role_id === 1) {
            return redirect()->route('unauthorized');
        }

        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // Set role as coordinator
            'email_verified_at' => now(), // Auto verify coordinator email
        ]);

        return redirect()->route('dashboard')
            ->with('status', 'Coordenador registrado com sucesso.');
    }
}
