<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
<<<<<<< Updated upstream
// use Illuminate\Support\Str;

// use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
>>>>>>> Stashed changes

class PelaporanController extends Controller
{
    public function index()
    {
        $data_pelaporans = Pelaporan::all();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_pelaporans,
            ], 200);
    }

    public function klasifikasiNaiveBayes(Request $request)
{
    $input = $request->all();
    $validatedData = Validator::make($input, [
        'judul_pelaporan' => 'required|string',
        'isi_pelaporan' => 'required|string',
        'jenis_product' => 'required|string',
        'harapan' => 'required|string',
        'status' => 'required|string',
    ]);

    if ($validatedData->fails()) {
        return response()->json(['status' => "error", "message" => $validatedData->errors()], 400);
    }

    $command = escapeshellcmd("python D:\Tugas\NaiveBayes\modules\bayes.py '{$input['isi_pelaporan']}'");
    $output = shell_exec($command);
    $output = trim($output);
    
    $picPelaporan = '';
    if ($output === 'Software') {
        $reportCountPic1 = Pelaporan::join('users', 'data_pelaporans.user_id', '=', 'users.id')
                                    ->where('users.role_id', '=', '2')
                                    ->where('users.nama_karyawan', '=', 'Rahmat Yoyok P.')
                                    ->count();
        $reportCountPic2 = Pelaporan::join('users', 'data_pelaporans.user_id', '=', 'users.id')
                                    ->where('users.role_id', '=', '2')
                                    ->where('users.nama_karyawan', '=', 'Agus Setyawan')
                                    ->count();
                                    

        if ($reportCountPic1 < $reportCountPic2) {
            $picPelaporan = 'Rahmat Yoyok P.';
        } else {
            $picPelaporan = 'Agus Setyawan';
        }

    }
    elseif ($output === 'Hardware') {
        $reportCountPic3 = Pelaporan::join('users', 'data_pelaporans.user_id', '=', 'users.id')
                        ->where('users.role_id', '=', '3')
                        ->where('users.nama_karyawan', '=',  'Arya Anuraga')
                        ->value('users.nama_karyawan');
        $picPelaporan = $reportCountPic3;
    }
    // $picPelaporan = '';

    // if ($output === 'Software') { 
    //     $reportCountPic1 = Pelaporan::where('pic_pelaporan', '=', 'Rahmat Yoyok P.')->count();
    //     $reportCountPic2 = Pelaporan::where('pic_pelaporan', '=', 'Agus Setyawan')->count();
    
    // if ($reportCountPic1 < $reportCountPic2) {
    //     $picPelaporan = 'Rahmat Yoyok P.';
    // } else {
    //     $picPelaporan = 'Agus Setyawan';
    // }
    // }
    // elseif ($output === 'Hardware') {
    //     $picPelaporan = 'Ahmad Zaki Ubaid';
    // }    

        $current = Carbon::now()->toDateTimeString();
        $trialExpires = Carbon::now()->addDays('3');
        $user = Auth::user();
        $kode_id = IdGenerator::generate(['table' => 'data_pelaporans', 'field' => 'id_pelaporan', 'length' => 10, 'prefix' => 'BUG-']);
        $newTraining = Pelaporan::create([
            'id_pelaporan' => $kode_id,
            'user_id' => $user->id,
            'judul_pelaporan' => $input['judul_pelaporan'],
            'isi_pelaporan' => $input['isi_pelaporan'],
            'harapan' => $input['harapan'],
            'jenis_product' => $input['jenis_product'],
            'status' => $input['status'],
            // 'lampiran' => $input['lampiran'],
            'tanggal_mulai' => $current,
            'tanggal_selesai' => $trialExpires,
            'class' => $output,
            'pic_pelaporan' => $picPelaporan
        ]);

    return response()
    ->json([
        'status' => 'success',
        'data' => $newTraining,
    ], 201);
}

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'judul_pelaporan' => 'required|string',
            'isi_pelaporan' => 'required|string',
            'jenis_product' => 'required|string',
            'harapan' => 'required|string',
            'status' => 'required|string',
            'lampiran' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => "error", "message" => $validator->errors()], 400);
        }
        $current = Carbon::now()->toDateTimeString();
        $trialExpires = Carbon::now()->addDays('3');
        
        $kode_id = IdGenerator::generate(['table' => 'data_pelaporans', 'field' => 'id_pelaporan', 'length' => 10, 'prefix' => 'BUG-']);
<<<<<<< Updated upstream
        $newPelaporan = Pelaporan::create([
            'id_pelaporan' => $kode_id,
            'judul_pelaporan' => $input['judul_pelaporan'],
            'isi_pelaporan' => $input['isi_pelaporan'],
            'harapan' => $input['harapan'],
            'status' => $input['status'],
            'lampiran' => $input['lampiran'],
            'tanggal_mulai' => $current,
            'tanggal_selesai' => $trialExpires,
            'jenis_product' => $input['jenis_product'],
        ]);
=======
        $user = Auth::user();

        $newPelaporan = new Pelaporan();
        $newPelaporan->id_pelaporan = $kode_id;
        $newPelaporan->user_id = $user->id;
        $newPelaporan->judul_pelaporan = $request->judul_pelaporan;
        $newPelaporan->isi_pelaporan = $request->isi_pelaporan;
        $newPelaporan->harapan = $request->harapan;
        $newPelaporan->jenis_product = $request->jenis_product;
        $newPelaporan->pic_pelaporan = $request->pic_pelaporan;
        $newPelaporan->tanggal_mulai = $current;
        $newPelaporan->tanggal_selesai = $trialExpires;
        $newPelaporan->status = $request->status;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $fileUrl = $file->storeAs('public', $filename);
        $newPelaporan->lampiran = Storage::url($fileUrl);
        }
        $newPelaporan->save();
>>>>>>> Stashed changes
        //Setiap bentukan data baru response status harus 201
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
        $pelaporan = Pelaporan::where('id_pelaporan', $id)->first();
        $input = $request->all();
        if (!$pelaporan) return $this->responseFailed('Data not found', '', 404);
        $validator = Validator::make($input, [
            'judul_pelaporan'      => 'string',
            'isi_pelaporan'      => 'string',
            'jenis_product'      => 'string',
            'harapan'      => 'string',
            'status'     => 'string',
            'lampiran'  => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $pelaporan->update($input);
        $data = Pelaporan::where('id_pelaporan', $id)->first();
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
