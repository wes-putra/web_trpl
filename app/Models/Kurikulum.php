<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $primaryKey = 'kurikulum_id';

    protected $fillable = [
        'semester',
        'file_kurikulum'
    ];
}
