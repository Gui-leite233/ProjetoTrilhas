<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Tcc;

class TccController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tcc::orderBy('titulo')->get();
        return view('tcc.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tcc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'titulo' => 'required|max:100|min:10',
            'descricao' => 'required|max:1000|min:20'
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($regras, $msgs);
        $reg = new Tcc();
        $reg->titulo = $request->titulo;
        $reg->descricao = $request->descricao;
        $reg->save();

        $extensao_arq = $request->file('documento')->getClientOriginalExtension();
        $nome_arq = $reg->id . '_' . time() . '.' . $extensao_arq;
        $request->file('documento')->storeAs("public/", $nome_arq);
        $reg->documento = $nome_arq;
        $reg->save();
        return redirect()->route('tcc.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Prova::find($id);

        if (isset($data)) {
            return view('prova.edit', compact('data'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obj = Prova::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        $regras = [
            'titulo' => 'required|max:100|min:10',
            'descricao' => 'required|max:1000|min:20',
        ];

        $msgs = [
            "required" => "O preenchimento do campo :attribute é obrigatório!",
            "max" => "O campo :attribute possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo :attribute possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        $obj->titulo = $request->titulo;
        $obj->descricao = $request->descricao;
        $obj->data = $request->data;
        $obj->save();

        $extensao_arq = $request->file('documento')->getClientOriginalExtension();
        $nome_arq = $obj->id . '_' . time() . '.' . $extensao_arq;
        $request->file('documento')->storeAs("public/", $nome_arq);
        $obj->documento = $nome_arq;
        $obj->save();

        return redirect()->route('tcc.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obj = Tcc::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        $obj->destroy($id);

        return redirect()->route('tcc.index');
    }
}