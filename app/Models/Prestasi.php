<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'prestasi_id';

    protected $fillable = [
        'nama_prestasi',
        'gambar',
        'keterangan',
    ];
}
