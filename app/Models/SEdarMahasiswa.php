<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEdarMahasiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'surat_edar_id';

    protected $fillable = [
        'nama_surat_edar',
        'file_surat_edar',
        'keterangan'
    ];
}
