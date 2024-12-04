<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolsa extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'curso_id', 'ativo'];

    
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
