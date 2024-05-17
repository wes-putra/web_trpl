<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerjasamaMitra extends Model
{
    use HasFactory;

    protected $primaryKey = 'mitra_id';

    protected $fillable = [
        'nama_mitra',
        'logo_mitra',
        'alamat_mitra',
    ];
}
