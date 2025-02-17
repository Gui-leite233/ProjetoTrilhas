<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resumo;
use App\Models\User;
use App\Models\Role;
use App\Models\Aluno;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ResumoController extends BaseController
{
    private $dompdf;

    public function __construct() 
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->dompdf = new Dompdf();
        $this->dompdf->setPaper('A4', 'portrait');
        DB::enableQueryLog(); // Enable query logging for debugging
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Resumo::with(['users' => function($query) {
            $query->select('users.id', 'users.nome', 'users.curso_id', 'users.ano', 'users.role_id')
                  ->with(['curso', 'role']);
        }])->get();
        
        $userResumoCount = null;
        
        // Check if user is authenticated before checking permissions
        if (auth()->check() && auth()->user()->can('viewCount', Resumo::class)) {
            $userResumoCount = User::select('users.id', 'users.nome')
                ->withCount(['resumos' => function($query) {
                    $query->whereNull('deleted_at');
                }])
                ->where('id', auth()->id())
                ->first();
        }
        
        return view('resumo.index', compact('data', 'userResumoCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', 'Aluno');
            })
            ->get();

        return view('resumo.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'titulo' => 'required|max:20',
            'descricao' => 'required',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'documento' => 'required|file|mimes:pdf|max:10000',
        ];

        $msgs = [
            "required" => "O campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "exists" => "O usuário selecionado não existe no banco de dados!",
            "mimes" => "O documento deve ser um arquivo PDF",
        ];

        $request->validate($regras, $msgs);

        $resumo = new Resumo();
        $resumo->titulo = $request->titulo;
        $resumo->descricao = $request->descricao;
        $resumo->user_id = auth()->id();
        $resumo->curso_id = auth()->user()->curso_id; // Add this line to get curso_id from authenticated user
        $resumo->save();

        if ($request->hasFile('documento')) {
            $extensao_arq = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $resumo->id . '_' . time() . '.' . $extensao_arq;
            $request->file('documento')->storeAs("public/", $nome_arq);
            $resumo->documento = $nome_arq;
            $resumo->save();
        }

        
        $resumo->users()->sync($request->user_ids);

        return redirect()->route('resumo.index');
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
        $data = Resumo::find($id);

        if (!isset($data)) {
            return redirect()->route('resumo.index')
                ->with('error', 'resumo não encontrado');
        }

        // Get all users with role 'aluno', similar to create method
        $alunos = User::with(['role', 'curso'])
            ->whereHas('role', function ($query) {
                $query->where('name', 'Aluno');
            })
            ->get();

        return view('resumo.edit', compact('data', 'alunos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obj = Resumo::find($id);

        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        $regras = [
            'titulo' => 'required|max:100|min:10',
            'descricao' => 'required|max:1000|min:20',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ];

        $msgs = [
            "required" => "O preenchimento do campo :attribute é obrigatório!",
            "max" => "O campo :attribute possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo :attribute possui tamanho mínimo de [:min] caracteres!",
            "exists" => "O usuário selecionado não existe no banco de dados!"
        ];

        $request->validate($regras, $msgs);

        $obj->titulo = $request->titulo;
        $obj->descricao = $request->descricao;
        $obj->save();

        // Update the users relationship
        $obj->users()->sync($request->user_ids);

        if ($request->hasFile('documento')) {
            // Delete old file if exists
            if ($obj->documento) {
                Storage::disk('public')->delete($obj->documento);
            }
            
            $extensao_arq = $request->file('documento')->getClientOriginalExtension();
            $nome_arq = $obj->id . '_' . time() . '.' . $extensao_arq;
            $request->file('documento')->storeAs("public/", $nome_arq);
            $obj->documento = $nome_arq;
            $obj->save();
        }

        return redirect()->route('resumo.index')
            ->with('success', 'Resumo atualizado com sucesso!');
    }

    public function downloadPdf($id)
    {
        $resumo = Resumo::findOrFail($id);

        if (!$resumo || !$resumo->documento) {
            return redirect()->route('resumo.index')
                ->with('error', 'resumo ou documento não encontrado.');
        }

        if (!Storage::disk('public')->exists($resumo->documento)) {
            Log::error('PDF file not found: ' . $resumo->documento);
            return redirect()->route('resumo.index')
                ->with('error', 'Arquivo não encontrado.');
        }

        $filePath = Cache::remember('resumo_path_' . $id, 60, function () use ($resumo) {
            return Storage::disk('public')->path($resumo->documento);
        });

        return Response::download($filePath, $resumo->documento, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment'
        ]);
    }

    public function viewPdf($id)
    {
        $resumo = Resumo::find($id);

        if (!$resumo || !$resumo->documento) {
            return redirect()->route('resumo.index')->with('error', 'Resumo ou documento não encontrado.');
        }

        $filePath = storage_path('app/public/' . $resumo->documento);

        if (!file_exists($filePath)) {
            return redirect()->route('resumo.index')->with('error', 'Arquivo não encontrado.');
        }

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $resumo->documento . '"'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obj = Resumo::find($id);


        if (!isset($obj)) {
            return "<h1>ID: $id não encontrado!</h1>";
        }

        $obj->destroy($id);

        return redirect()->route('resumo.index');
    }
}
