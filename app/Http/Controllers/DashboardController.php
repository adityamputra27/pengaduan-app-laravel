<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pengaduan;

class DashboardController extends Controller
{
    public function home()
    {
        //if(Auth::check())
        //{
    		$latest = Pengaduan::where('status', '0')->take(3);
            return view('components.user.dashboard', compact('latest'));
        //}
    }
}
