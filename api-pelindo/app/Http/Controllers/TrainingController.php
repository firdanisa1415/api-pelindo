<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TrainingController extends Controller
{
    public function index()
    {
        $data_training = Training::all();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_training,
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
            'lampiran' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => "error", "message" => $validator->errors()], 400);
        }
        $current = Carbon::now()->toDateTimeString();
        $trialExpires = Carbon::now()->addDays('3');
        
        $kode_id = IdGenerator::generate(['table' => 'data_data_training', 'field' => 'id_pelaporan', 'length' => 10, 'prefix' => 'BUG-']);
        $newTraining = Training::create([
            'id_pelaporan' => $kode_id,
            'judul_pelaporan' => $input['judul_pelaporan'],
            'isi_pelaporan' => $input['isi_pelaporan'],
            'harapan' => $input['harapan'],
            'status' => $input['status'],
            'lampiran' => $input['lampiran'],
            'tanggal_mulai' => $current,
            'tanggal_selesai' => $trialExpires,
            'jenis_product' => $input['jenis_product'],
            'pic_pelaporan' => $input['pic_pelaporan'],
        ]);
        //Setiap bentukan data baru response status harus 201
        return response()
            ->json([
                'status' => 'success',
                'data' => $newTraining,
            ], 201);
    }

    public function show($id)
    {
        // dd(Data_Pelaporan::find($id));
        $data_training = Training::find($id);
        if (!$data_training) {
            return response()
                ->json([
                    'status' => 'Error',
                    'message' => 'Data Not Found!',
                ], 404);
        }

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_training,
            ], 200);
    }

    public function update(Request $request, $id)
    {
        $training = Training::where('id_pelaporan', $id)->first();
        $input = $request->all();
        if (!$training) return $this->responseFailed('Data not found', '', 404);
        $validator = Validator::make($input, [
            'judul_pelaporan'      => 'string',
            'isi_pelaporan'      => 'string',
            'jenis_product'      => 'string',
            'pic_pelaporan' => 'string',
            'harapan'      => 'string',
            'status'     => 'string',
            'lampiran'  => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $training->update($input);
        $data = Training::where('id_pelaporan', $id)->first();
        return $this->responseSuccess('Pelaporan has been updated', $data, 200);
    }

    public function destroy($id)
    {
        $training = Training::where('id_pelaporan', $id)->first();
        if (!$training) return $this->responseFailed('Data not found', '', 404);
        $training->delete();
        return $this->responseSuccess('Data has been deleted');
    }
}
