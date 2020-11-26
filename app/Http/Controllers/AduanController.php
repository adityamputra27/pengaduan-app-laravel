<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaduan;
use Auth;
use App\Kategori;
use Session;
use PDF;
use App\DetailLaporanView;

class AduanController extends Controller
{
    public function form_aduan()
    {
        $max = Pengaduan::max('id_pengaduan');
        $max4 = $max[1].$max[2].$max[3].$max[4];        
        $max4++;
        if($max4 <= 9){
            $max4 = "P000".$max4;
        }elseif ($max4 <= 99) {
            $max4 = "P00".$max4;
        }elseif ($max4 <= 999) {
            $max4 = "P0".$max4;
        }elseif ($max4 <= 99) {
            $max4 = "P".$max4;
        }
        $kategori = Kategori::all();
        return view('components.user.aduan.aduan', compact('kategori', 'max4'));
    }
    public function dashboard()
    {
        //if(Auth::check())
        //{
            $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    ->orderBy('status', 'ASC')->withTrashed()->get();
            $jml_pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    ->orderBy('status', 'ASC')->withTrashed()->count();
            $belum = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    // ->where('status', '0')
                                    ->where(function ($query){
                                        $query->where('status', '0');
                                    })
                                    ->get();
            $jml_belum = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    // ->where('status', '0')
                                    ->where(function ($query){
                                        $query->where('status', '0');
                                    })
                                    ->count();
            $proses = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    ->where(function ($query){
                                        $query->where('status', 'proses');
                                    })
                                    ->get();
            $jml_proses = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    ->where(function ($query){
                                        $query->where('status', 'proses');
                                    })
                                    ->count();
            $selesai = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    ->where(function ($query){
                                        $query->where('status', 'selesai');
                                    })
                                    ->get();
            $jml_selesai = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    ->where(function ($query){
                                        $query->where('status', 'selesai');
                                    })
                                    ->count();
            $ditolak = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    ->where(function ($query){
                                        $query->whereNotNull('deleted_at');
                                    })
                                    ->get();
            $jml_ditolak = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)
                                    ->where(function ($query){
                                        $query->whereNotNull('deleted_at');
                                    })
                                    ->count();

            return view('components.user.dashboard', compact('pengaduan', 'belum', 'proses', 'selesai', 'ditolak', 'jml_pengaduan', 'jml_belum', 'jml_proses', 'jml_selesai', 'jml_ditolak'));
        //}
    }
    public function simpan(Request $request)
    {
        $this->validate($request, [
            'isi_laporan' => 'required',
            'id_kategori' => 'required',
            'foto' => 'required',
            'foto.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            foreach($foto as $files)
            {
                $tujuan_upload = 'assets/uploads/';
                $nama_file = time().".".$files->getClientOriginalExtension();
                $files->move($tujuan_upload, $nama_file);
                $data[] = $nama_file;
            }
            $aduan = new Pengaduan;
            $aduan->id_pengaduan = $request->id_pengaduan;
            $aduan->isi_laporan = $request->isi_laporan;
            $aduan->id_kategori = $request->id_kategori;
            $aduan->foto = json_encode($data);
            $aduan->tgl_pengaduan = date('Y-m-d H:i:s');
            $aduan->nik = Auth::guard('masyarakat')->user()->nik;
            $aduan->status = '0';
        }
        else {
            $aduan = new Pengaduan;
            $aduan->id_pengaduan = $request->id_pengaduan;
            $aduan->isi_laporan = $request->isi_laporan;
            $aduan->id_kategori = $request->id_kategori;
            $aduan->tgl_pengaduan = date('Y-m-d H:i:s');
            $aduan->nik = Auth::guard('masyarakat')->user()->nik;
            $aduan->status = '0';
        }
        $simpan = $aduan->save();
        if($simpan)
        {
            Session::flash('save', 'Laporan (Aduan) Berhasil Di Kirim!');
            return redirect()->route('user_dashboard');
            //}
        }
        else 
        {
            Session::flash('error', 'Laporan (Aduan) Gagal Di Kirim!');
            return redirect()->route('user_dashboard');
        }
    }
    public function download(Request $request, $id)
    {
        $detail = DetailLaporanView::with('masyarakat', 'kategori_aduan', 'petugas')
                        ->where('id_pengaduan', $id)
                        ->first();
        $id = DetailLaporanView::where('id_pengaduan', $id)->first();
        $cetak = PDF::loadView('components.user.aduan.download', ['detail' => $detail], ['id' => $id])->setPaper('A4', 'potrait');
        return $cetak->download(Auth::guard('masyarakat')->user()->nik.'-'.date('d-M-Y').'.pdf');
    }
    public function show($id)
    {
        $show = Pengaduan::with('kategori_aduan')->where('id_pengaduan', $id)->first();
        return view('components.user.aduan.show', compact('show'));
    }
    public function cari(Request $request)
    {
        // $search = Pengaduan::where('id_pengaduan', 'like', '%'.$request->searchAduan.'%')->get();
        // return json_encode($search);
        // if ($request->has('q')) {
        //     $q = $request->q;
        //     $result = Pengaduan::where('id_pengaduan', 'like', '%'.$q.'%')->get();
        //     return response()->json(['data' => $result]);
        // } else {
        //     return view('components.user.dashboard');
        // }
        if (empty($request->searchAduan)) {
            echo "<div class='alert alert-warning'> <i class='fa fa-exclamation-triangle'></i> <b>Input Kode Aduan Yang Ingin Dicari!</b></div>";
            // echo "Data Tidak Ada!";
        }
        else
        {
            $show = Pengaduan::where('id_pengaduan', 'like', '%'.$request->searchAduan.'%')->get();
            return view('components.user.show-search', compact('show'));
        }
    }
}
