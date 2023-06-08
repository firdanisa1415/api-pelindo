<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pelaporan extends Model
{
    use HasFactory;

    protected $table = 'data_pelaporans';
    protected $fillable = [
        'id_pelaporan',
        'user_id',
        'judul_pelaporan',
        'isi_pelaporan',
        'jenis_product',
        'pic_pelaporan',
        'nama_pic',
        'lampiran',
        'harapan',
        'klasifikasi',
        'status',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public static function getListPic(){
        $subquery = DB::table('data_pelaporans as aa')
            ->select('aa.pic_pelaporan', 'bb.id as id_pic', 'bb.email','cc.nama_karyawan as pelapor','cc.email as mailpelapor', DB::raw('count(aa.pic_pelaporan) as jumlah'))
            ->leftJoin('users as bb', DB::raw('aa.pic_pelaporan'), '=', 'bb.id')
            ->join('users as cc', 'cc.id', '=', 'aa.user_id')
            ->whereNotNull('aa.pic_pelaporan')
            ->whereNotNull('bb.id')
            ->whereIn('aa.klasifikasi', ['Informasi', 'Aplikasi', 'Infrastruktur', 'People'])
            ->groupBy('aa.pic_pelaporan', 'bb.id', 'bb.email', 'cc.nama_karyawan', 'cc.email')
            ->orderBy('jumlah', 'asc')
            ->limit(1);

        $results = DB::table(DB::raw('(' . $subquery->toSql() . ') as insiden'))
            ->select('insiden.id_pic', 'bb.nama_karyawan as pic','bb.email', 'insiden.jumlah', 'insiden.pelapor', 'insiden.mailpelapor')
            ->leftJoin('users as bb', 'bb.id', '=', 'insiden.id_pic')
            ->mergeBindings($subquery)
            ->get();

        return $results;
    }

}
