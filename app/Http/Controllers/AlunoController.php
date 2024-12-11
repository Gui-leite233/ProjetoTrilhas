<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\User;

class AlunoController extends Controller
{
    private $regras;
    private $mensagens = [
        "required" => "O preenchimento do campo :attribute é obrigatório!",
        "integer" => "O campo :attribute deve ser um número inteiro!",
        "min" => "O campo :attribute deve ser maior ou igual a :min!",
        "max" => "O campo :attribute deve ser menor ou igual a :max!",
        "exists" => "O valor do campo :attribute não é válido!",
    ];

    public function __construct()
    {
        $this->regras = [
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'usuario_id' => 'required|exists:users,id',
            'curso_id' => 'required|exists:cursos,id',
        ];
    }

    public function index()
    {
        $data = Aluno::with(['usuario:id,nome,email', 'curso:id,nome'])
            ->select('id', 'ano', 'usuario_id', 'curso_id')
            ->orderBy('ano', 'desc')
            ->paginate(15);
        return view('aluno.index', compact('data'));
    }

    public function create()
    {
        $usuarios = User::select('id', 'nome')
            ->orderBy('nome')
            ->get();
        $cursos = Curso::select('id', 'nome')
            ->orderBy('nome')
            ->get(); 
        return view('aluno.create', compact('usuarios', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate($this->regras, $this->mensagens);
        Aluno::create($request->only(['ano', 'usuario_id', 'curso_id']));
        return redirect()->route('aluno.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        $dados = Aluno::findOrFail($id);
        return view('aluno.edit', compact('dados'));
    }

    public function update(Request $request, string $id)
    {
        $obj = Aluno::findOrFail($id);
        $request->validate($this->regras, $this->mensagens);
        $obj->update($request->only(['ano', 'usuario_id', 'curso_id']));
        return redirect()->route('aluno.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $obj = Aluno::findOrFail($id);
        $obj->delete();
        return redirect()->route('aluno.index')->with('success', 'Aluno excluído com sucesso!');
    }
}
