<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TugasController extends Controller
{
    public function index()
    {
        $data_tugas = Tugas::all();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_tugas,
            ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'story_id'      => 'required|string',
            'isi_tugas'      => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $storyId = $request->input('story_id');
        $dataStory = Story::find($storyId);
        if (!$dataStory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data story not found!'
            ], 404);
        };

        $data_tugas = new Tugas();
        $data_tugas->story_id = $request->story_id;
        $data_tugas->isi_tugas = $request->isi_tugas;
        $data_tugas->save();

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_tugas,
            ], 200);
    }

    public function show($id)
    {
        $data_tugas = Tugas::find($id);
        if (!$data_tugas) {
            return response()
                ->json([
                    'status' => 'Error',
                    'message' => 'Data Not Found!',
                ], 404);
        }

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_tugas,
            ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'story_id'      => 'string',
            'isi_tugas'      => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data_tugas = Tugas::find($id);
        if (!$data_tugas) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_tugas->fill($request->all());
        $data_tugas->save();
        return response()->json([
            'status' => 'Success',
            'data' => $data_tugas,
        ], 200);
    }

    public function destroy($id)
    {
        $data_tugas = Tugas::find($id);
        if (!$data_tugas) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_tugas->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted'
        ]);
    }
}
