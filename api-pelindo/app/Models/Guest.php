<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $table = 'data_tamu';
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'subjek',
        'lampiran'
    ];
}
