<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name'];

    public static function getDefaultRoles()
    {
        return self::orderBy('name')->get();
    }
}
