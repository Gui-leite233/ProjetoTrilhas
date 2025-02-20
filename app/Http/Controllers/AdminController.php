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
                'users' => User::count(),
                'cursos' => Curso::count(),
                'tccs' => Tcc::count(),
                'provas' => Prova::count(),
                'bolsas' => Bolsa::count(),
                'projetos' => Projeto::count(),
                'resumos' => Resumo::count(),
            ]
        ]);
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
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