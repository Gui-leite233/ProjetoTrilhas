<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index()
    {
        $data = Curso::all();
        return view('curso.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('curso.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        try {
            $reg = new Curso();
            $reg->nome = $request->nome;
            $result = $reg->save();

            \Log::info('Curso save result: ' . ($result ? 'success' : 'failure'));

            if (!$result) {
                \Log::error('Failed to save Curso: ' . $reg->getErrors());
            }
        } catch (\Exception $e) {
            \Log::error('Exception when saving Curso: ' . $e->getMessage());
            // Optionally, you could redirect back with an error message
            // return redirect()->back()->with('error', 'Failed to save the course.');
        }

        //return redirect()->route('curso.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
