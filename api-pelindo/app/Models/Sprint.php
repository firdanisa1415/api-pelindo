<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;
    protected $table = 'data_sprint';
    protected $fillable = ['id_sprint', 'nama_sprint', 'tanggal_mulai', 'tanggal_akhir'];

    const CREATED_AT = 'tanggal_mulai';
    const UPDATED_AT = 'tanggal_akhir';

    protected $casts = [
        'tanggal_mulai' => 'datetime:Y-m-d H:m:s',
        'tanggal_akhir' => 'datetime:Y-m-d H:m:s',
    ];


    public $incrementing = false;

    protected $primaryKey = 'id_sprint';
    protected $keyType = 'string';

    
    public function stories()
    {
        return $this->hasMany(Story::class, 'sprint_id');
    }
}
