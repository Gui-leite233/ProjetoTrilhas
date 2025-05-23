<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projeto;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;

class ProjetoController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']); // Allow index without auth
        
    }
    public function index()
    {
        $data = Projeto::with(['users' => function($query) {
            $query->select('users.id', 'users.nome', 'users.curso_id', 'users.ano', 'users.role_id')
                  ->with(['curso', 'role']);
        }])->get();
        
        return view('projeto.index', compact('data'));
    }
    

    public function create()
    {
        $users = User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', 'Aluno');
            })
            ->get();

        return view('projeto.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'titulo' => 'required|max:255',
            'descricao' => 'required',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ];

        $msgs = [
            "required" => "O campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "exists" => "O usuário selecionado não existe no banco de dados!",
        ];

        $request->validate($regras, $msgs);

        $projeto = new Projeto();
        $projeto->titulo = $request->titulo;
        $projeto->descricao = $request->descricao;
        $projeto->user_id = auth()->id();
        $projeto->save();

        
        $projeto->users()->sync($request->user_ids);

        return redirect()->route('admin.projeto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projeto = Projeto::find($id);

        if (!isset($projeto)) {
            return redirect()->route('admin.projeto.index')->with('error', 'Projeto não encontrado.');
        }

        return view('projeto.show', compact('projeto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projeto = Projeto::with('users')->find($id);
        
        if (!isset($projeto)) {
            return redirect()->route('admin.projeto.index')->with('error', 'Projeto não encontrado.');
        }

        $users = User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', 'Aluno');
            })
            ->get();

        return view('projeto.edit', compact('projeto', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $projeto = Projeto::find($id);

        if (!isset($projeto)) {
            return redirect()->route('admin.projeto.index')->with('error', 'Projeto não encontrado.');
        }

        $regras = [
            'titulo' => 'required|max:255',
            'descricao' => 'required',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ];

        $msgs = [
            "required" => "O campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "exists" => "O usuário selecionado não existe no banco de dados!",
        ];

        $request->validate($regras, $msgs);

        $projeto->titulo = $request->titulo;
        $projeto->descricao = $request->descricao;
        $projeto->save();

        // Sync the users relationship
        $projeto->users()->sync($request->user_ids);

        return redirect()->route('admin.projeto.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projeto = Projeto::find($id);

        if (!isset($projeto)) {
            return redirect()->route('admin.projeto.index')->with('error', 'Projeto não encontrado.');
        }

        $projeto->delete();

        return redirect()->route('admin.projeto.index');
    }
}
