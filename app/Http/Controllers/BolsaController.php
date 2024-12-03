<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolsa;
use App\Models\Curso;

class BolsaController extends Controller
{
    
    public function index()
    {
        $data = Bolsa::orderBy('titulo')->get();
        return view('bolsa.index', compact('data'));
    }

   
    public function create()
    {
        $cursos = Curso::orderBy('nome')->pluck('nome', 'id');
        return view('bolsa.create', compact(['cursos']));
    }

    
    public function store(Request $request)
    {
        $regras = [
            'titulo' => 'required|max:255|min:5',
            'descricao' => 'nullable|max:65535',
            'curso_id' => 'required|integer',
            'ativo' => 'required|boolean',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
            "integer" => "O campo [:attribute] deve ser um número inteiro!",
            "boolean" => "O campo [:attribute] deve ser verdadeiro ou falso!",
        ];

        //$request->validate($regras, $msgs);

        $reg = new Bolsa();
        $reg->titulo = $request->titulo;
        $reg->descricao = $request->descricao;
        $reg->curso_id = $request->curso_id;
        $reg->ativo = $request->ativo;
        $reg->save();

        return redirect()->route('bolsa.index');
    }

    
    public function show(string $id)
    {
        $data = Bolsa::find($id);

        if (!isset($data)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('bolsa.show', compact('data'));
    }

    
    public function edit(string $id)
    {
        $data = Bolsa::find($id);

        if (!isset($data)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        return view('bolsa.edit', compact('data'));
    }

    
    public function update(Request $request, string $id)
    {
        $obj = Bolsa::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        $regras = [
            'titulo' => 'required|max:255|min:5',
            'descricao' => 'nullable|max:65535',
            'curso_id' => 'required|integer',
            'ativo' => 'required|boolean',
        ];

        $msgs = [
            "required" => "O preenchimento do campo :attribute é obrigatório!",
            "max" => "O campo :attribute possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo :attribute possui tamanho mínimo de [:min] caracteres!",
            "integer" => "O campo :attribute deve ser um número inteiro!",
            "boolean" => "O campo :attribute deve ser verdadeiro ou falso!",
        ];

        $request->validate($regras, $msgs);

        $obj->titulo = $request->titulo;
        $obj->descricao = $request->descricao;
        $obj->curso_id = $request->curso_id;
        $obj->ativo = $request->ativo;
        $obj->save();

        return redirect()->route('bolsa.index')->with('success', 'Bolsa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obj = Bolsa::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        $obj->delete();

        return redirect()->route('bolsa.index');
    }
}
