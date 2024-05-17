<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $primaryKey = 'berita_id';

    protected $fillable = [
        'judul_berita',
        'isi_berita',
        'tgl_berita',
        'gambar'
    ];
}
