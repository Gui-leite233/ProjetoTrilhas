<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tcc;
use App\Models\Aluno;
use App\Models\Role;
use App\Models\User;  // Add this line to import User model
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Illuminate\Routing\Controller as BaseController;

class TccController extends BaseController
{
    private $dompdf;

    public function __construct() 
    {
        // Remove parent::__construct() - it's not needed
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->dompdf = new Dompdf();
        $this->dompdf->setPaper('A4', 'portrait');
        DB::enableQueryLog(); // Enable query logging for debugging
    }

    public function index()
    {
        $tcc = Tcc::with([
            'users' => function($query) {
                $query->with(['role', 'aluno.curso', 'curso']);
            }
        ])->get();

        return view('tcc.index', compact('tcc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::with(['role', 'curso'])
            ->whereHas('role', function($query) {
                $query->where('name', 'Aluno');
            })
            ->get();

        return view('tcc.create', compact('users'));
    }

    /* Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'titulo' => 'required|max:255',
            'descricao' => 'required',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'documento' => 'required|file|mimes:pdf|max:2048',
        ];
        
        $msgs = [
            "required" => "O campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "exists" => "O aluno selecionado não é válido!",
            "mimes" => "O documento deve ser um arquivo PDF",
        ];
        
        $request->validate($regras, $msgs);
        
        $tcc = new Tcc();
        $tcc->titulo = $request->titulo;
        $tcc->descricao = $request->descricao;
        $tcc->user_id = auth()->id();
        $tcc->save();

        // Handle document upload
        if ($request->hasFile('documento')) {
            $extensao_arq = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $tcc->id . '_' . time() . '.' . $extensao_arq;
            $request->file('documento')->storeAs("public/", $nome_arq);
            $tcc->documento = $nome_arq;
            $tcc->save();
        }

        // Sync users
        $tcc->users()->sync($request->user_ids);

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
        $user = auth()->user();
        
        // If user is aluno, only show their own record
        if ($user->hasRole('aluno')) {
            $alunos = Aluno::with(['usuario', 'curso'])
                ->where('user_id', $user->id)
                ->get();
        } 
        // If user is admin or other role, show all alunos
        else {
            $alunos = Aluno::with(['usuario', 'curso'])
                ->whereHas('usuario.role', function($query) {
                    $query->where('name', 'aluno');
                })
                ->orWhere('user_id', auth()->id())
                ->get();
        }

        if (!isset($data)) {
            return redirect()->route('tcc.index')
                ->with('error', 'TCC não encontrado');
        }

        return view('tcc.edit', compact('data', 'alunos'));
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
            return "<h1>ID: $id não encontrado!</h1>";
        }

        $obj->destroy($id);

        return redirect()->route('tcc.index');
    }
}

