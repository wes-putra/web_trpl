<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'role_id';
    protected $table = 'roles';
    protected $fillable = [
        'nama_role',
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }
}
