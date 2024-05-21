<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    use HasFactory;

    protected $primaryKey = 'sejarah_id';

    protected $fillable = [
        'isi_sejarah',
        'gambar'
    ];
}
