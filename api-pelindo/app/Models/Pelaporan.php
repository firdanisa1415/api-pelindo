<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory;

    protected $table = 'data_pelaporans';
    protected $fillable = [
        'id_pelaporan',
        'judul_pelaporan',
        'isi_pelaporan',
        'jenis_product',
        'lampiran',
        'harapan',
        'status',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    // const CREATED_AT = 'tanggal_mulai';
    // const UPDATED_AT = 'tanggal_selesai';

    // protected $casts = [
    //     'tanggal_mulai' => 'datetime:Y-m-d H:m:s',
    //     'tanggal_selesai' => 'datetime:Y-m-d H:m:s',
    // ];

    // public $incrementing = false;

    // protected $primaryKey = 'id_pelaporan';
    // protected $keyType = 'string';

}
