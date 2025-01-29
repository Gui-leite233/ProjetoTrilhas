<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Curso;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $roles = Role::all();
        $cursos = Curso::all();
        
        // Debug info
        \Log::info('Registration Form Data:', [
            'roles_count' => $roles->count(),
            'cursos_count' => $cursos->count()
        ]);
        
        return view('auth.register', compact('roles', 'cursos'));
    }

    protected function validator(array $data)
    {
        \Log::info('Validation Data:', $data);
        
        $rules = [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
        ];

        // Add curso_id and ano validation only if role is Aluno (role_id = 3)
        if (isset($data['role_id']) && $data['role_id'] == 3) {
            $rules['curso_id'] = ['required', 'exists:cursos,id'];
            $rules['ano'] = ['required', 'integer', 'min:1', 'max:5'];
        }

        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        \Log::info('Registration Data Received:', $data);  // Debug log

        // Create user with basic data
        return User::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'curso_id' => isset($data['role_id']) && $data['role_id'] == 3 ? $data['curso_id'] : null,
            'ano' => isset($data['role_id']) && $data['role_id'] == 3 ? $data['ano'] : null,
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        \Log::info('Register Request Data:', $request->all());  // Debug log

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        \Log::info('User Registered Successfully:', ['user_id' => $user->id]);  // Debug log

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}