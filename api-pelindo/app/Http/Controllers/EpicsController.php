<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Epics;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;

class EpicsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data_epics = Epics::where('user_id', $user->id)->with('stories')->get();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_epics,
            ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_epic'      => 'required|string',
            'isi_epic'      => 'required|string',
            'harapan' => 'required|string',
            'status'      => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $kode_id = IdGenerator::generate(['table' => 'data_epics', 'field' => 'id_epic', 'length' => 10, 'prefix' => 'EPC-']);
        $user = Auth::user();
        $data_epics = new Epics();
        $data_epics->id_epic = $kode_id;
        $data_epics->user_id = $user->id;
        $data_epics->judul_epic = $request->judul_epic;
        $data_epics->isi_epic = $request->isi_epic;
        $data_epics->harapan = $request->harapan;
        $data_epics->status = $request->status;

        $data_epics->save();

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_epics,
            ], 200);
    }

    public function show($id)
    {
        $data_epic = Epics::find($id)->with('stories')->get();;
        if (!$data_epic) {
            return response()
                ->json([
                    'status' => 'Error',
                    'message' => 'Data Not Found!',
                ], 404);
        }

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_epic,
            ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul_epic'      => 'string',
            'isi_epic'      => 'string',
            'harapan' => 'string',
            'status'      => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data_epic = Epics::find($id);
        if (!$data_epic) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_epic->fill($request->all());
        $data_epic->save();
        return response()->json([
            'status' => 'Success',
            'data' => $data_epic,
        ], 200);
    }

    public function destroy($id)
    {
        $data_epic = Epics::find($id);
        if (!$data_epic) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_epic->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted'
        ]);
    }
}
