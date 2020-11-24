<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengaduan;
use Auth;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        // if (Auth::guard('petugas')->check()) {
        //     $notif_count = Pengaduan::where('status', '0')->count();
        //     $notif = Pengaduan::where('status', '0')->get();
        //     return view('components.admin.index', compact('notif', 'notif_count'));
        // }
        // $notif_count = DB::table('pengaduans')->select(DB::raw('COUNT(isi_laporan)'))->where('status', '0')->count();
        // $notif = Pengaduan::where('status', '=', '0')->get();
        if (Auth::check()) {
            $all = Pengaduan::count();
            $verify = Pengaduan::where('status', '0')->count();
            $process = Pengaduan::where('status', 'proses')->count();
            $finish = Pengaduan::where('status', 'selesai')->count();
            $latest = Pengaduan::where('status', '0')->paginate(3);
            return view('components.admin.index', compact('latest', 'all', 'verify', 'process', 'finish'));
        }
        return redirect()->route('admin.login');
    }
}
