<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tcc extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'aluno_id', 'documento'];

    
    public function aluno()
    {
        return $this->belongsTo(Aluno::class); 
    }
}

