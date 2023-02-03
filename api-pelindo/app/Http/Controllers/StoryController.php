<?php

namespace App\Http\Controllers;

use App\Models\Epics;
use App\Models\Sprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Story;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StoryController extends Controller
{
    public function index()
    {
        $data_story = Story::with('sprint')->get();
        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_story,
            ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'epic_id'      => 'required|string',
            'sprint_id'      => 'required|string',
            'isi_story'      => 'required|string',
            'status'        => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $kode_id = IdGenerator::generate(['table' => 'data_story', 'field' => 'id_story', 'length' => 10, 'prefix' => 'STR-']);

        $epicId = $request->input('epic_id');
        $dataEpic = Epics::find($epicId);
        if (!$dataEpic) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data epic not found!'
            ], 404);
        };
        $sprintId = $request->input('sprint_id');
        $dataSprint = Sprint::find($sprintId);
        if (!$dataSprint) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data sprint not found!'
            ], 404);
        };

        $data_story = new Story();
        $data_story->id_story = $kode_id;
        $data_story->epic_id = $request->epic_id;
        $data_story->sprint_id = $request->sprint_id;
        $data_story->isi_story = $request->isi_story;
        $data_story->status = $request->status;
        $data_story->save();

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_story,
            ], 200);
    }

    public function show($id)
    {
        $data_story = Story::find($id);
        if (!$data_story) {
            return response()
                ->json([
                    'status' => 'Error',
                    'message' => 'Data Not Found!',
                ], 404);
        }

        return response()
            ->json([
                'status' => 'Success',
                'data' => $data_story,
            ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'epic_id'      => 'string',
            'sprint_id'      => 'string',
            'isi_story'      => 'string',
            'status'        => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $data_story = Story::find($id);
        if (!$data_story) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_story->fill($request->all());
        $data_story->save();
        return response()->json([
            'status' => 'Success',
            'data' => $data_story,
        ], 200);
    }

    public function destroy($id)
    {
        $data_story = Story::find($id);
        if (!$data_story) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Data not found!'
            ], 404);
        };

        $data_story->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data deleted'
        ]);
    }
}