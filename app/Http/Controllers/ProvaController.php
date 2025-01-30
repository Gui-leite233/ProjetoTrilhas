<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prova;
use App\Models\Curso;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ProvaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Prova::orderBy('titulo')->get();
        return view('prova.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prova.create');
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
        $reg = new Prova();
        $reg->titulo = $request->titulo;
        $reg->descricao = $request->descricao;
        $reg->save();

        $extensao_arq = $request->file('documento')->getClientOriginalExtension();
        $nome_arq = $reg->id . '_' . time() . '.' . $extensao_arq;
        $request->file('documento')->storeAs("public/", $nome_arq);
        $reg->documento = $nome_arq;
        $reg->save();

        /*if ($request->hasFile('documento')) {
        }*/


        /*$pdf = PDF::loadView('pdf_view', $reg);

        $pdf->render();
        $pdf->stream("relatorio-horas-turma.pdf", array("Attachment" => false));*/

        return redirect()->route('admin.prova.index');
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

        //$request->validate($regras, $msgs);
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

        return redirect()->route('admin.prova.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obj = Prova::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!";
        }

        $obj->destroy($id);

        return redirect()->route('admin.prova.index');
    }

    public function viewPdf($id)
    {
        $prova = Prova::find($id);

        if (!$prova || !$prova->documento) {
            return redirect()->route('admin.prova.index')->with('error', 'Prova ou documento não encontrado.');
        }

        $filePath = storage_path('app/public/' . $prova->documento);

        if (!file_exists($filePath)) {
            return redirect()->route('admin.prova.index')->with('error', 'Arquivo não encontrado.');
        }

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $prova->documento . '"'
        ]);
    }

    public function downloadPdf($id)
    {
        $prova = Prova::findOrFail($id);

        if (!$prova || !$prova->documento) {
            return redirect()->route('admin.prova.index')
                ->with('error', 'Prova ou documento não encontrado.');
        }

        if (!Storage::disk('public')->exists($prova->documento)) {
            Log::error('PDF file not found: ' . $prova->documento);
            return redirect()->route('admin.prova.index')
                ->with('error', 'Arquivo não encontrado.');
        }

        $filePath = Cache::remember('prova_path_' . $id, 60, function () use ($prova) {
            return Storage::disk('public')->path($prova->documento);
        });

        return Response::download($filePath, $prova->documento, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment'
        ]);
    }
}
