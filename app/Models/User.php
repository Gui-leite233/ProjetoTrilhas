<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'password',
        'role_id',
        'curso_id',
        'ano',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the aluno associated with the user.
     */
    public function aluno()
    {
        return $this->hasOne(Aluno::class, 'user_id');
    }

    /**
     * Get the curso associated with the user.
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    /**
     * Get the resumos associated with the user.
     */
    public function resumos()
    {
        return $this->belongsToMany(Resumo::class, 'resumo_user');
    }

    /**
     * Check if user has specific role
     */
    public function hasRole($role)
    {
        return $this->role && $this->role->name === $role;
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin()
    {
        return $this->role && $this->role->name === 'Admin' && $this->is_admin===1;
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        $timestamp = now();
        $this->forceFill([
            'email_verified_at' => $timestamp,
        ]);
        
        $saved = $this->save();
        
        if ($saved) {
            \Log::info("Email verified for user {$this->id} at {$timestamp}");
        } else {
            \Log::error("Failed to verify email for user {$this->id}");
        }
        
        return $saved;
    }
}
