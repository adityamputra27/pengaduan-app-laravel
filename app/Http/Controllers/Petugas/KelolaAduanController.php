<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengaduan;
use App\Tanggapan;
use Auth;
use App\Kategori;
use Session;

class KelolaAduanController extends Controller
{
    public function home()
    {
        // $pengaduan = Pengaduan::orderBy('status', 'ASC')
        //             ->join('tanggapans', 'tanggapans.id_pengaduan', '=', 'pengaduans.id_pengaduan')
        //             ->get();
        $pengaduan = Pengaduan::orderBy('status', 'ASC')->get();
        return view('components.admin.aduan.index', compact('pengaduan'));
    }
    public function verifikasi_aduan($id)
    {
        $verif = Pengaduan::where('id', $id)->first();
        $act = $verif->update(['status' => 'proses']);
        if($act)
        {
            Session::flash('save', 'Laporan Aduan Berhasil Di Verifikasi!');
            return redirect()->route('kelola_aduan');
            //}
        }
        else 
        {
            Session::flash('error', 'Laporan Aduan Gagal Di Verifikasi!');
            return redirect()->route('kelola_aduan');
        }
    }
    public function detail_aduan($id)
    {
        $detail = Pengaduan::where('id_pengaduan', $id)->get();
        return view('components.admin.aduan.detail', compact('detail'));
    }
    public function tolak_aduan(Request $request, $id)
    {   
        $result = Pengaduan::where('id', $request->id);
        $act = $result->delete();
        if ($act) {
            Session::flash('save', 'Aduan Berhasil Di Tolak! Silahkan Lihat Daftar Aduan Yang Di Tolak!');
            return redirect()->route('kelola_aduan');
        }
    }
    public function tampil_tolak_aduan()
    {
        $tampil = Pengaduan::onlyTrashed()->get();
        return view('components.admin.aduan.aduan-tolak', compact('tampil'));
    }
    public function restore_aduan(Request $request, $id)
    {
        $result = Pengaduan::withTrashed()->where('id', $request->id)->first();
        $act = $result->restore();
        if ($act) {
            Session::flash('save', 'Aduan Berhasil Di Restore! Silahkan Lihat Daftar Aduan!');
            return redirect()->route('aduan_tolak');
        }
    }
    public function kill_aduan(Request $request, $id)
    {
        $result = Pengaduan::withTrashed()->where('id', $request->id)->first();
        // $result2 = Tanggapan::where('id_', $re);
        $act = $result->forceDelete();
        if ($act) {
            Session::flash('save', 'Aduan Berhasil Di Hapus Permanen!');
            return redirect()->route('aduan_tolak');
        }
    }
}
