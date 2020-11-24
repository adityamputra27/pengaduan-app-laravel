<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Petugas;
use Validator;
use Auth;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('guest:petugas')->except('logout');
    //     $this->middleware('guest:masyarakat')->except('logout');
    // }
    // PETUGAS LOGIN
    public function login_petugas()
    {
        $check_user = Petugas::count();
        return view('components.admin.auth.login', compact('check_user'));  
    }
    public function verify_login_petugas(Request $request)
    {
        $rules = [
            'username'              => 'required',
            'password'              => 'required'
        ];

        $messages = [
            'username.required'     => 'Username Wajib Diisi!',
            'password.required'     => 'Password Wajib Diisi!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $data = [
            'username'              => $request->input('username'),
            'password'              => $request->input('password'),
        ];
 
        if (Auth::guard('petugas')->attempt($data)) { // Mengecek, jika true / login success redirect ke dashboard
            //Login Success
            return redirect('/app');
 
        } else { // Jika false
 
            //Login Gagal
            Session::flash('error', 'Username atau Password Salah!');
            return redirect()->route('admin.login');
        }
    }
    // MASYARAKAT LOGIN
    public function login_masyarakat()
    {
        return view('components.user.auth.login');
    }
    public function verify_login_masyarakat(Request $request)
    {
        $rules = [
            'username'              => 'required',
            'password'              => 'required'
        ];

        $messages = [
            'username.required'     => 'Username Wajib Diisi!',
            'password.required'     => 'Password Wajib Diisi!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $data = [
            'username'              => $request->input('username'),
            'password'              => $request->input('password')
        ];
 
        if (Auth::guard('masyarakat')->attempt($data)) { // Mengecek, jika true / login success redirect ke dashboard
            //Login Success
            
            return redirect('/dashboard');
 
        } else { // Jika false
 
            //Login Gagal
            Session::flash('error', 'Username atau Password Salah!');
            return redirect()->route('user.login');
        }
    }
    public function logout_petugas()
    {
        Auth::guard('petugas')->logout();
        return redirect()->route('admin.login');
    }
    public function logout_masyarakat()
    {
        Auth::guard('masyarakat')->logout(); // menghapus session yang aktif
        return redirect()->route('user.login');
    }
}
