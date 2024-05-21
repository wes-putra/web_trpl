<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisiTujuan extends Model
{
    use HasFactory;

    protected $primaryKey = 'vmt_id';

    protected $fillable = [
        'isi_visi',
        'isi_misi',
        'isi_tujuan'
    ];
}
