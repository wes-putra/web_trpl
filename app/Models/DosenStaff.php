<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenStaff extends Model
{
    use HasFactory;

    protected $primaryKey = 'dosen_id';

    protected $fillable = [
        'nama',
        'foto',
        'jabatan',
    ];
}
