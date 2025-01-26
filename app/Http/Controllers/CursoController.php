<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    private $regras = [
        'nome' => 'required|max:100|min:10',
        'descricao' => 'required|max:1000|min:20',
        'link' => 'required|url',  // Adicione esta linha para validar o link
    ];

    private $mensagens = [
        "required" => "O preenchimento do campo :attribute é obrigatório!",
        "max" => "O campo :attribute possui tamanho máximo de :max caracteres!",
        "min" => "O campo :attribute possui tamanho mínimo de :min caracteres!",
        "url" => "O campo :attribute deve ser uma URL válida!",  // Mensagem de erro para URL inválida
    ];


    public function index()
    {
        $data = Curso::orderBy('nome')->get();
        return view('curso.index', compact('data'));
    }

    public function create()
    {
        return view('curso.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->regras, $this->mensagens);

        Curso::create($request->only(['nome', 'descricao', 'link']));  // Inclua 'link' aqui

        return redirect()->route('curso.index');
    }

    public function edit(string $id)
    {
        $dados = Curso::findOrFail($id);
        return view('curso.edit', compact('dados'));
    }

    public function update(Request $request, string $id)
    {
        $obj = Curso::findOrFail($id);

        $request->validate($this->regras, $this->mensagens);

        $obj->update($request->only(['nome', 'descricao', 'link']));  // Inclua 'link' aqui

        return redirect()->route('curso.index');
    }

    public function destroy(string $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->bolsas()->delete();
        $curso->delete();

        return redirect()->route('curso.index');
    }

    
}