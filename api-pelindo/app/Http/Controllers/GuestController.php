<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use App\Models\Guest;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    public function sendEmail(Request $request)
    {
        $pengaduan = new Guest();
        $pengaduan->nama = $request->input('nama');
        $pengaduan->email = $request->input('email');
        $pengaduan->telepon = $request->input('telepon');
        $pengaduan->subjek = $request->input('subjek');
        $pengaduan->save();

        $details = [
            'nama' => $pengaduan->nama,
            'email' => $pengaduan->email,
            'telepon' => $pengaduan->telepon,
            'subjek' => $pengaduan->subjek,
        ];
    
        Mail::to($pengaduan->email)->send(new SendMail($details));
    
        return response()->json([
            'status' => 'success',
            'message' => 'Pengaduan berhasil dikirim']);
    }
}
