<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $validator = Validator::make($input, [
            'judul_pelaporan' => 'required|string',
            'isi_pelaporan' => 'required|string',
            'jenis_product' => 'required|string',
            'pic_pelaporan' => 'required|string',
            'harapan' => 'required|string',
            'status' => 'required|string',
            'file' => 'nullable|file|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => "error", "message" => $validator->errors()], 400);
        }

        $current = Carbon::now()->toDateTimeString();
        $trialExpires = Carbon::now()->addDays('3');
        
        $kode_id = IdGenerator::generate(['table' => 'data_pelaporans', 'field' => 'id_pelaporan', 'length' => 10, 'prefix' => 'BUG-']);
        $user = Auth::user();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $fileUrl = $file->storeAs('public', $filename);
    
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
        $newPelaporan->lampiran = Storage::url($fileUrl);
        }
        $newPelaporan->save();
        //Setiap bentukan data baru response status harus 201
        Log::info($input);

        return response()
            ->json([
                'status' => 'success',
                'data' => $newPelaporan,
                'file_url' => $newPelaporan->lampiran,
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
            'pic_pelaporan' => 'string',
            'harapan'      => 'string',
            'status'     => 'string',
            // 'lampiran'  => 'string'
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
