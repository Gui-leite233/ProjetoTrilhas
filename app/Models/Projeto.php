<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'aluno_id',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }
}
