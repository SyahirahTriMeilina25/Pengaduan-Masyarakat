<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::all();
        return view('Admin.Masyarakat.index', ['masyarakat' => $masyarakat]);
    }
    public function show($nik)
    {
        $masyarakat = Masyarakat::where('nik', $nik)->first();
        return view('Admin.Masyarakat.show', ['masyarakat' => $masyarakat]);
    }
    public function destroy(Masyarakat $masyarakat)
    {
        $pengaduan = Pengaduan::where('nik', $masyarakat->nik)->first();

        if (!$pengaduan) {
            DB::table('masyarakat')->where('nik', $masyarakat->nik)->delete(); return redirect()->route('masyarakat.index');
        } else {
            return redirect()->back()->with(['notif' => 'Tidak Bisa Menghapus Pengguna']);
        }
    }

}
