<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaporan;
use Carbon\Carbon;
// use Faker\UniqueGenerator;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
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
        $validator = Validator::make($request->all(), [
            // 'id_pelaporan'      => 'string',
            // 'no_ticket'      => 'required|string',
            'judul_pelaporan'      => 'required|string',
            'isi_pelaporan'      => 'required|string',
            'jenis_product'      => 'required|string',
            // 'jenis_pelaporan'    => 'required|string',
            'harapan'      => 'required|string',
            'status'     => 'required|string',
            'lampiran'  => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $current = Carbon::now()->toDateTimeString();
        $trialExpires = Carbon::now()->addDays('3');
        // $coba = Carbon::now()->add('3')->toDateTimeString();

        // $kode_id = UniqueIdGenerator::generate(['table' => 'data_pelaporans', 'length' => 8,'prefix' => 'BUG-']);
    //     $todo = new Todo();
    //     $todo->id = $id;
    //     $todo->title = $request->get('title');
    //     $todo->save();
    // }
    // // Inv-000121 Inv-000221 Inv-000322 Inv-000422
    
        $kode_id = IdGenerator::generate (['table' => 'data_pelaporans','field' => 'id_pelaporan','length' => 10, 'prefix' => 'BUG-']);

        $data_pelaporans = new Pelaporan();
        $data_pelaporans->id_pelaporan = $kode_id;
        $data_pelaporans->judul_pelaporan = $request->judul_pelaporan;
        $data_pelaporans->isi_pelaporan = $request->isi_pelaporan;
        $data_pelaporans->jenis_product = $request->jenis_product;
        $data_pelaporans->harapan = $request->harapan;
        $data_pelaporans->status = $request->status;
        $data_pelaporans->lampiran = $request->lampiran;
        $data_pelaporans->tanggal_mulai = $current;
        $data_pelaporans->tanggal_selesai = $trialExpires;
        $data_pelaporans->save();

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_pelaporans,
            ], 200);
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
        $validator = Validator::make($request->all(), [
            // 'id_pelaporan'      => 'string|max:255',
            // 'no_ticket'      => 'string',
            'judul_pelaporan'      => 'string',
            'isi_pelaporan'      => 'string',
            'jenis_product'      => 'string',
            // 'jenis_pelaporan'    => 'string',
            'harapan'      => 'string',
            'status'     => 'string',
            'lampiran'  => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data_pelaporan = Pelaporan::find($id);
        if (!$data_pelaporan) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_pelaporan->fill($request->all());
        $data_pelaporan->save();
        return response()->json([
            'status' => 'Success',
            'data' => $data_pelaporan,
        ], 200);
    }

    public function destroy($id)
    {
        $data_pelaporan = Pelaporan::find($id);
        if (!$data_pelaporan) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_pelaporan->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted'
        ]);
    }
}
