<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'projeto_user', 'projeto_id', 'user_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
