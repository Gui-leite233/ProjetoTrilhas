<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nome'];

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}
