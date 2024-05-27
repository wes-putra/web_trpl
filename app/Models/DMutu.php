<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DMutu extends Model
{
    use HasFactory;

    protected $primaryKey = 'Dmutu_id';

    protected $fillable = [
        'nama_Dmutu',
        'file_Dmutu',
        'keterangan',
    ];
}
