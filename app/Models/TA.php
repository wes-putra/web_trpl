<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TA extends Model
{
    use HasFactory;

    protected $primaryKey = 'ta_id';


    protected $fillable = [
        'nama_file_ta',
        'file_ta',
        'keterangan'
    ];
}
