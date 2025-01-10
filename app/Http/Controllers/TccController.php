<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tcc;
use App\Models\Aluno;
//use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;

class TccController extends Controller
{
    private $dompdf;

    public function __construct() {
        $this->dompdf = new Dompdf();
        $this->dompdf->setPaper('A4', 'portrait');  // opcional
    }

    public function index()
    {
        // Busca todos os TCCs do banco de dados
        $tccs = Tcc::with('aluno')->get(); // Inclua a relação 'aluno' se ela existir
        
        // Retorna a view com a variável $tccs
        return view('tcc.index', compact('tccs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tcc.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'titulo' => 'required|max:255',
            'descricao' => 'required',
            'documento' => 'file|mimes:pdf,doc,docx|max:2048',
        ];
        $msgs = [
            "required" => "O campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($regras, $msgs);
        
        $reg = new Tcc();
        $reg->titulo = $request->titulo;
        $reg->descricao = $request->descricao;
        $reg->save();

        if ($request->hasFile('documento')) {
            $extensao_arq = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $reg->id . '_' . time() . '.' . $extensao_arq;
            $request->file('documento')->storeAs("public/", $nome_arq);
            $reg->documento = $nome_arq;
            $reg->save();
        } else {
            echo ("erro");
        }

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
        $data = Tcc::find($id);

        if (isset($data)) {
            return view('tcc.edit', compact('data'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obj = Tcc::find($id);

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
        $obj->save();

        if ($request->hasFile('documento')) {
            $extensao_arq = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $obj->id . '_' . time() . '.' . $extensao_arq;
            $request->file('documento')->storeAs("public/", $nome_arq);
            $obj->documento = $nome_arq;
            $obj->save();
        }

        return redirect()->route('tcc.index');
    }

    public function viewPdf($id)
    {
        $tcc = Tcc::find($id);

        if (!$tcc || !$tcc->documento) {
            return redirect()->route('tcc.index')->with('error', 'TCC ou documento não encontrado.');
        }

        $filePath = storage_path('app/public/' . $tcc->documento);

        if (!file_exists($filePath)) {
            return redirect()->route('tcc.index')->with('error', 'Arquivo não encontrado.');
        }

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $tcc->documento . '"'
        ]);
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
