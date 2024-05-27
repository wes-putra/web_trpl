<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKI extends Model
{
    use HasFactory;

    protected $primaryKey = 'mki_id';


    protected $fillable = [
        'nama_file_mki',
        'file_mki',
        'keterangan'
    ];
}
