<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaporan;

class PelaporanController extends Controller
{
    public function index()
    {
        $pelaporan = Pelaporan::all();
        return response([
            'success' => true,
            'message' => 'List Semua pelaporan',
            'data' => $pelaporan
        ], 200);
    }

    public function create()
    {
        return view('pelaporan.create');
    }

    public function store(Request $request)
    {

        //Todo: Add try catch block
        try {
            $report = Pelaporan::create($request->all());
            $data = Pelaporan::where('id', $report->id)->first();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Menambahkan Pelaporan',
            ], 500);
        }


        //Return JSON not redirection



        //    return redirect()->route('pelaporan.index')
        //                     ->with('success','User created successfully.');
    }


    public function show(Pelaporan $pelaporan)
    {
        return view('pelaporan.show', compact('pelaporan'));
    }

    public function edit(Pelaporan $user)
    {
        return view('pelaporan.edit', compact('pelaporan'));
    }

    public function update(Request $request, Pelaporan $pelaporan)
    {
        $pelaporan->update($request->all());

        return redirect()->route('pelaporan.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(Pelaporan $pelaporan)
    {
        $pelaporan->delete();

        return redirect()->route('pelaporan.index')
            ->with('success', 'Pelaporan deleted successfully');
    }
}
