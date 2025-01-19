<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['user_id', 'curso_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curso() {
        return $this->belongsTo(Curso::class);
    }
}
