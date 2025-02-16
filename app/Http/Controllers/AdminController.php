<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curso;
use App\Models\Role;
use App\Models\Tcc;
use App\Models\Prova;
use App\Models\Bolsa;
use App\Models\Projeto;
use App\Models\Resumo;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        return view('admin.index', [
            'stats' => [
                'users' => \App\Models\User::count(),
                'cursos' => \App\Models\Curso::count(),
                'tccs' => \App\Models\Tcc::count(),
                'provas' => \App\Models\Prova::count(),
                'bolsas' => \App\Models\Bolsa::count(),
                'projetos' => \App\Models\Projeto::count(),
                'resumos' => \App\Models\Resumo::count(),
            ]
        ]);
    }

    public function users()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function reports()
    {
        $monthlyStats = [
            'uploads' => [
                'tccs' => Tcc::whereMonth('created_at', now()->month)->count(),
                'provas' => Prova::whereMonth('created_at', now()->month)->count(),
                'projetos' => Projeto::whereMonth('created_at', now()->month)->count(),
            ],
            'users' => User::whereMonth('created_at', now()->month)->count(),
        ];

        return view('admin.reports', compact('monthlyStats'));
    }
}