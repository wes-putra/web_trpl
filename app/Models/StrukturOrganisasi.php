<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'struktur_id';

    protected $fillable = [
        'judul',
        'file_struktur'
    ];
}