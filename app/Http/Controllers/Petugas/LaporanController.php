<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Petugas;
use App\Masyarakat;
use App\Pengaduan;
use App\Kategori;
use PDF;

class LaporanController extends Controller
{
    public function home()
    {
        return view('components.admin.laporan.index');
    }
    public function lap_petugas()
    {
        $petugas = Petugas::all();
        $jumlah = Petugas::count();
        $cetak = PDF::loadView('components.admin.laporan.petugas', ['petugas' => $petugas], ['jumlah' => $jumlah])->setPaper('A4', 'potrait');;
        return $cetak->download('laporan_petugas('.date('d-M-Y').').pdf');
    }
    public function lap_masyarakat()
    {
        $msy = Masyarakat::all();
        $jumlah = Masyarakat::count();
        $cetak = PDF::loadView('components.admin.laporan.masyarakat', ['msy' => $msy], ['jumlah' => $jumlah])->setPaper('A4', 'potrait');
        return $cetak->download('laporan_masyarakat('.date('d-M-Y').').pdf');
    }
    public function lap_aduan(Request $request)
    {
        $detail = Pengaduan::with('masyarakat', 'kategori_aduan', 'petugas')
                        ->join('tanggapans', 'tanggapans.id_pengaduan', '=', 'pengaduans.id_pengaduan')
                        ->select('tanggapans.*', 'pengaduans.*')
                        ->whereBetween('pengaduans.tgl_pengaduan', [$request->tglawal, $request->tglakhir])
                        ->get();
        $jml = Pengaduan::with('masyarakat', 'kategori_aduan', 'petugas')
                        ->join('tanggapans', 'tanggapans.id_pengaduan', '=', 'pengaduans.id_pengaduan')
                        ->select('tanggapans.*', 'pengaduans.*')
                        ->whereBetween('pengaduans.tgl_pengaduan', [$request->tglawal, $request->tglakhir])
                        ->count();
        $tgl = date('d M Y', strtotime($request->tglawal)) ." - ". date('d M Y', strtotime($request->tglakhir));
        return view('components.admin.laporan.aduan', compact('detail', 'tgl', 'jml'));
        // $cetak = PDF::loadView('components.admin.laporan.aduan', ['detail' => $detail])->setPaper('A4', 'potrait');
        // return $cetak->download('laporan_aduan('.date('d-M-Y').').pdf');
    }
}
