<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TanggapanController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        // Validasi input
        $pengaduan = Pengaduan::where("id_pengaduan", $request->id_pengaduan)->first();

        $request->validate([
            'status' => [
                'required',
                Rule::in(['0', 'proses', 'selesai']),
            ],
            'tanggapan' => [
                'required_if:status,proses,selesai',
            ],
        ], [
            'status.required' => 'Status wajib diisi.',
            'tanggapan.required_if' => 'Tanggapan wajib diisi',
        ]);

        $tanggapan = Tanggapan::where("id_pengaduan", $request->id_pengaduan)->first();

        if ($tanggapan) {
            $pengaduan->update(['status' => $request->status]);

            if ($request->status === 'proses' || $request->status === 'selesai') {
                $tanggapan->update([
                    'tgl_tanggapan' => now(),
                    'tanggapan' => $request->tanggapan,
                    'id_petugas' => Auth::guard('admin')->user()->id_petugas,
                ]);
            } else {
                $tanggapan->delete();
            }

            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Dikirim!']);
        } else {
            $pengaduan->update(['status' => $request->status]);

            if ($request->status === 'proses' || $request->status === 'selesai') {
                $tanggapan = Tanggapan::create([
                    'id_pengaduan' => $request->id_pengaduan,
                    'tgl_tanggapan' => now(),
                    'tanggapan' => $request->tanggapan,
                    'id_petugas' => Auth::guard('admin')->user()->id_petugas,
                ]);
            }

            return redirect()->route('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan])->with(['status' => 'Berhasil Dikirim!']);
        }
    }
}
