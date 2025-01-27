<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tcc extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'user_id', 'documento'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tcc_user', 'tcc_id', 'user_id');
    }
}

