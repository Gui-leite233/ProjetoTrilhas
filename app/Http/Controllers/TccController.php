<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tcc;
use App\Models\Aluno;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Illuminate\Support\Collection;


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
        $tccs = Tcc::with(['users' => function($query) {
            $query->select('users.id', 'users.nome');
        }])->get();
        
        foreach ($tccs as $tcc) {
            \Log::info('TCC details:', [
                'id' => $tcc->id,
                'titulo' => $tcc->titulo,
                'users' => $tcc->users->pluck('nome')
            ]);
        }
        
        return view('tcc.index', compact('tccs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::with('role')
            ->whereHas('role', function($query) {
                $query->where('name', 'Aluno');
            })
            ->get();
        
        return view('tcc.create', ['users' => $users]);
    }

    /* Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            \Log::info('TCC Store Request:', ['request_data' => $request->all()]);
            
            $validated = $request->validate([
                'titulo' => 'required',
                'descricao' => 'required',
                'user_ids' => 'required|array',
                'documento' => 'nullable|file|mimes:pdf'
            ]);

            DB::beginTransaction();

            // Create TCC with first user as main
            $tcc = Tcc::create([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'user_id' => $request->user_ids[0]
            ]);

            \Log::info('TCC created:', ['tcc' => $tcc->toArray()]);

            // Sync all selected users
            $tcc->users()->sync($request->user_ids);
            
            \Log::info('Users synced:', [
                'tcc_id' => $tcc->id,
                'user_ids' => $request->user_ids,
                'pivot_records' => DB::table('tcc_user')->where('tcc_id', $tcc->id)->get()
            ]);

            // Handle document if present
            if ($request->hasFile('documento')) {
                $file = $request->file('documento');
                $filename = $tcc->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public', $filename);
                $tcc->update(['documento' => $filename]);
            }

            DB::commit();

            return redirect()->route('tcc.index')
                ->with('success', 'TCC criado com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating TCC:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro ao criar TCC: ' . $e->getMessage()]);
        }
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

