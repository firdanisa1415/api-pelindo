<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epics extends Model
{
    use HasFactory;
    protected $table = 'data_epics';
    protected $fillable = ['id_epic', 'judul_epic', 'isi_epic', 'status', 'tanggal_mulai', 'tanggal_selesai'];

    const CREATED_AT = 'tanggal_mulai';
    const UPDATED_AT = NULL;

    protected $casts = [
        'tanggal_mulai' => 'datetime:Y-m-d H:m:s',
    ];


    public $incrementing = false;

    protected $primaryKey = 'id_epic';
    protected $keyType = 'string';

    public function stories(){
        return $this->hasMany(Story::class, 'epic_id');
    }
}
