<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tanggapan;
use App\Pengaduan;
use App\Petugas;
use Session;
use Auth;
use DB;

class KelolaTanggapanController extends Controller
{
    public function index()
    {
        // $result = DB::table('pengaduans')
        //             ->join('tanggapans', 'tanggapans.id_pengaduan', '=', 'pengaduans.id_pengaduan')
        //             ->select('pengaduans.*', 'tanggapans.*')
        //             ->get();
        $result = Pengaduan::where('status', '!=', '0')->get();
        // $id = Pengaduan::select('id_pengaduan')->get();
        return view('components.admin.tanggapan.index', compact('result'));
        //dd($result);
    }
    public function form_tanggapi($id)
    {
        $id = Pengaduan::where('id_pengaduan', $id)->first();
        return view('components.admin.tanggapan.isi_tanggapan', compact('id'));
    }
    public function tanggapi(Request $request)
    {
        $this->validate($request, [
            'tanggapan' => 'required'
        ]);
        $tanggapan = new Tanggapan;
        $tanggapan->id_pengaduan = $request->id_pengaduan;
        $tanggapan->tgl_tanggapan = $request->tgl_tanggapan;
        $tanggapan->tanggapan = $request->tanggapan;
        $tanggapan->id_petugas = Auth::guard('petugas')->user()->id;
        $act = $tanggapan->save();
        //$act2 = DB::table('pengaduans')->where('id_pengaduan', $request->id_pengaduan)->update(['status' => $request->status]);
        if ($act) {
            Session::flash('save', 'Laporan Aduan Berhasil Di Tanggapi!');
            return redirect()->route('kelola_tanggapan');
        }
        else {
            Session::flash('error', 'Laporan Aduan Gagal Di Tanggapi!');
            return redirect()->route('kelola_tanggapan');
            # code...
        }
    }
    public function selesai_tanggapan(Request $request, $id)
    {
        $selesai = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->update(['status' => 'selesai']);
        if ($selesai) {
            Session::flash('save', 'Laporan Aduan Selesai!');
            return redirect()->route('kelola_tanggapan');
        }
        else {
            Session::flash('error', 'Gagal!');
            return redirect()->route('kelola_tanggapan');
        }
    }
    public function detail_tanggapan(Request $request, $id)
    {
        $detail = Pengaduan::with('masyarakat', 'kategori_aduan', 'petugas')
                        ->join('tanggapans', 'tanggapans.id_pengaduan', '=', 'pengaduans.id_pengaduan')
                        ->select('tanggapans.*', 'pengaduans.*')
                        ->where('tanggapans.id_pengaduan', $id)
                        ->first();
        // $detail = Pengaduan::join('tanggapans', 'pengaduans.id_pengaduan', '=', 'tanggapans.id_pengaduan')
        //                 ->select('tanggapans.*', 'pengaduans.*')
        //                 ->where('tanggapans.id_pengaduan', $request->id_pengaduan)
        //                 ->get();
        // print_r($detail);
        // dd($detail);
        return view('components.admin.tanggapan.detail_tanggapan', compact('detail'));
    }
}
