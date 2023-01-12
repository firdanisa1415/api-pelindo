<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
// use Haruncpi\LaravelIdGenerator\IdGenerator;
// use Illuminate\Support\Str;

// use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

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
        //Pastikan semua Import Library kayak IdGenerator atau Str itu sudah dipanggil di paling atas kode yang "use <nama-library", Otherwise bakal error 500;
        $newPelaporan = Pelaporan::create([
            'id_pelaporan' => "ID" . "-" . uniqid(),
            'judul_pelaporan' => $input['judul_pelaporan'],
            'isi_pelaporan' => $input['isi_pelaporan'],
            'harapan' => $input['harapan'],
            'status' => $input['status'],
            'lampiran' => $input['lampiran'],
            'tanggal_mulai' => $current,
            'tanggal_selesai' => $trialExpires,
            'jenis_product' => $input['jenis_product'],
        ]);
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
