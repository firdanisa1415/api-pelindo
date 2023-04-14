<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_karyawan',
        'nrp',
        'divisi',
        'role_id',
        'email',
        'password',
    ];

    public function getFillable()
    {
        return $this->fillable;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    public function divisi(){
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }
    public function pelaporan(){
        return $this->hasMany(Pelaporan::class,'user_id');
    }
    public function epics(){
        return $this->hasMany(Epics::class,'user_id');
    }
    public function sprint(){
        return $this->hasMany(Sprint::class,'user_id');
    }
}
