<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resumo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'resumos';
    
    protected $fillable = [
        'titulo', 
        'descricao', 
        'documento', 
        'user_id', 
        'curso_id'
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'resumo_user', 'resumo_id', 'user_id')
                    ->withTimestamps();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
