<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SprintController extends Controller
{
    public function index()
    {
        $data_sprint = Sprint::with('stories')->get();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_sprint,
            ], 200);
    }

    public function store(Request $request)
    {
        $input =$request->all();
        $validator = Validator::make($input, [
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $current = Carbon::now()->toDateTimeString();
        $trialExpires = Carbon::now()->addMonth();

        $kode_id = IdGenerator::generate(['table' => 'data_sprint', 'field' => 'id_sprint', 'length' => 10, 'prefix' => 'SPR-']);

        $data_sprint = new Sprint();
        $data_sprint->id_sprint = $kode_id;
        $data_sprint->user_id = $user->id;
        $data_sprint->tanggal_mulai = $request->tanggal_mulai;
        $data_sprint->tanggal_akhir = $request->tanggal_akhir;
        $data_sprint->save();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_sprint,
            ], 200);
    }

    public function show($id)
    {
        // dd(Data_Pelaporan::find($id));
        $data_sprint = Sprint::find($id);
        if (!$data_sprint) {
            return response()
                ->json([
                    'status' => 'Error',
                    'message' => 'Data Not Found!',
                ], 404);
        }

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_sprint,
            ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_sprint'      => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data_sprint = Sprint::find($id);
        if (!$data_sprint) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_sprint->fill($request->all());
        $data_sprint->save();
        return response()->json([
            'status' => 'Success',
            'data' => $data_sprint,
        ], 200);
    }

    public function destroy($id)
    {
        $data_sprint = Sprint::find($id);
        if (!$data_sprint) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_sprint->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted'
        ]);
    }
}
