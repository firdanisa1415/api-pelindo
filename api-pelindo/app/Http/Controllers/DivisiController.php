<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DivisiController extends Controller
{
    public function index()
    {
        $data_divisi = Divisi::all();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_divisi,
            ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_divisi'      => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => "error", "message" => $validator->errors()], 400);
        }

        $data_divisi = new Divisi();
        $data_divisi->nama_divisi = $request->nama_divisi;
        $data_divisi->save();

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_divisi,
            ], 200);
    }

    public function show($id)
    {
        $data_divisi = Divisi::find($id);
        if (!$data_divisi) {
            return response()
                ->json([
                    'status' => 'Error',
                    'message' => 'Data Not Found!',
                ], 404);
        }

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_divisi,
            ], 200);
    }
}
