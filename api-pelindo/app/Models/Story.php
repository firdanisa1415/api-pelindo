<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $table = 'data_story';
    protected $primaryKey = 'id_story';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = ['id_story', 'epic_id', 'sprint_id','isi_story', 'status' ];

    public function epic(){
        return $this->belongsTo(Epics::class,'epic_id', 'id_epic');
    }
    public function task(){
        return $this->hasMany(Tugas::class, 'story_id');
    }
    public function sprint(){
        return $this->belongsTo(Sprint::class, 'sprint_id');
    }
}
