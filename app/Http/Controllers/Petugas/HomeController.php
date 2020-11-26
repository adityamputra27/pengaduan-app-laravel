<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengaduan;
use Auth;
use DB;
use Carbon\Carbon;
use App\Charts\DashboardChart;

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
            $data = DB::table('pengaduans')
                    ->select('tgl_pengaduan', DB::raw('count(*) as total'))
                    ->groupBy('tgl_pengaduan')
                    ->pluck('total', 'tgl_pengaduan')->all();
            for ($i=0; $i <= count($data) ; $i++) { 
                $colours[] = '#'.substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            }
            $chart = new DashboardChart;
            $chart->labels = (array_keys($data));
            $chart->dataset = (array_values($data));
            $chart->colours = $colours;

            return view('components.admin.index', compact('latest', 'all', 'verify', 'process', 'finish', 'chart'));
        }
        return redirect()->route('admin.login');
    }
}
