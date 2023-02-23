<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $table = 'data_data_training';
    protected $fillable = [
        'id_pelaporan',
        'judul_pelaporan',
        'isi_pelaporan',
        'jenis_product',
        'pic_pelaporan',
        'lampiran',
        'harapan',
        'status',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

}
