<?php

namespace App\Http\Controllers;

use App\Mail\PelaporanUpdated;
use App\Mail\SendMail;
use App\Mail\SendMailToPic;
use Illuminate\Http\Request;
use App\Models\Pelaporan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PelaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data_pelaporans = Pelaporan::where('user_id', $user->id)->with('user')->get();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_pelaporans,
            ], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
    $validatedData = Validator::make($input, [
        'judul_pelaporan' => 'required|string',
        'isi_pelaporan' => 'required|string',
        'jenis_product' => 'required|string',
        'harapan' => 'required|string',
        'status' => 'required|string',
        'klasifikasi' => 'string',
        'pic_pelaporan' => 'string',
        'nama_pic' => 'required|string',
        
    ]);

    if ($validatedData->fails()) {
        return response()->json(['status' => "error", "message" => $validatedData->errors()], 400);
    }

    // $command = escapeshellcmd("python D:\Tugas\NaiveBayes\modules\bayes.py '{$input['isi_pelaporan']}'");
    // $output = shell_exec($command);
    // $output = trim($output);

    // $picPelaporan = Pelaporan::getListPic()->first();

    // if ($picPelaporan) {
    //     $idPic = $picPelaporan->id_pic;
    //     $namaPic = $picPelaporan->pic;
    //     $picEmail = $picPelaporan->email;
    // } else {
    //     $idPic =null;
    //     $namaPic = null;
    // }

    // $picPelaporan = '';

    // if ($output === 'Software') { 
    //     $reportCountPic1 = Pelaporan::where('pic_pelaporan', '=', 1)->count();
    //     $reportCountPic2 = Pelaporan::where('pic_pelaporan', '=', 2)->count();
    
    // if ($reportCountPic1 < $reportCountPic2) {
    //     $picPelaporan = 1;
    // } else {
    //     $picPelaporan = 2;
    // }
    // }
    // elseif ($output === 'Hardware') {
    //     $picPelaporan = 3;
    // }    

    $current = Carbon::now()->toDateTimeString();
    $trialExpires = Carbon::now()->addDays('3');
    $user = Auth::user();
    $kode_id = IdGenerator::generate(['table' => 'data_pelaporans', 'field' => 'id_pelaporan', 'length' => 10, 'prefix' => 'BUG-']);
    $newPelaporan = Pelaporan::create([
        'id_pelaporan' => $kode_id,
        'user_id' => $user->id,
        'judul_pelaporan' => $input['judul_pelaporan'],
        'isi_pelaporan' => $input['isi_pelaporan'],
        'harapan' => $input['harapan'],
        'jenis_product' => $input['jenis_product'],
        'status' => $input['status'],
        'tanggal_mulai' => $current,
        'tanggal_selesai' => $trialExpires,
        'klasifikasi' => $input['klasifikasi'],
        // 'pic_pelaporan' => $idPic,
        'nama_pic'=>$input['nama_pic'],
    ]);

    // Mail::to($user->email)->send(new SendMail($newPelaporan, $user));
    // Mail::to($picEmail)->send(new SendMailToPic($newPelaporan,$picPelaporan));
return response()
->json([
    'status' => 'success',
    'data' => $newPelaporan,
], 201);
    }

    public function show($id)
    {
        // dd(Data_Pelaporan::find($id));
        $data_pelaporan = Pelaporan::find($id);
        if (!$data_pelaporan) {
            return response()
                ->json([
                    'status' => 'Error',
                    'message' => 'Data Not Found!',
                ], 404);
        }

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_pelaporan,
            ], 200);
    }

    public function update(Request $request, $id)
    {
        $pelaporan = Pelaporan::where('id', $id)->first();
        $input = $request->all();
        if (!$pelaporan) return $this->responseFailed('Data not found', '', 404);
        $validator = Validator::make($input, [
            'judul_pelaporan'      => 'string',
            'isi_pelaporan'      => 'string',
            'jenis_product'      => 'string',
            'harapan'      => 'string',
            'status'     => 'string',
            // 'lampiran'  => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $pelaporan->update($input);
        $data = Pelaporan::where('id', $id)->first();

        if ($data->status == "review") {
            $picPelaporan = User::find($data->pic_pelaporan);
            Mail::to($data->user->email)->send(new PelaporanUpdated($data, $picPelaporan));
        }

        return $this->responseSuccess('Pelaporan has been updated', $data, 200);
    }

    public function destroy($id)
    {
        $pelaporan = Pelaporan::where('id_pelaporan', $id)->first();
        if (!$pelaporan) return $this->responseFailed('Data not found', '', 404);
        $pelaporan->delete();
        return $this->responseSuccess('Data has been deleted');
    }
}
