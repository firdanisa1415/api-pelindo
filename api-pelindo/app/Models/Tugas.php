<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'data_tugas';
    protected $primaryKey = 'id_tugas';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = ['id_tugas', 'id_story', 'isi_tugas'];

    public function story(){
        return $this->belongsTo(Story::class,'story_id', 'id_story');
    }
}
