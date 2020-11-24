<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Petugas;
use Validator;
use Auth;
use App\Masyarakat;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('guest:petugas')->except('logout');
    //     $this->middleware('guest:masyarakat')->except('logout');
    // }
    // PETUGAS REGISTER
    public function verify_register_petugas(Request $request)
    {
        $rules = [
            'nama_petugas'            => 'required|min:3|max:200',
            'username'                => 'required|min:3|max:50',
            'password'                => 'required|min:6|max:50|confirmed'
        ];
 
        $messages = [
            'nama_petugas.required'   => 'Nama Lengkap Wajib Diisi!',
            'nama_petugas.min'        => 'Nama Lengkap Minimal 3 Karakter!',
            'nama_petugas.max'        => 'Nama Lengkap Maksimal 200 Karakter!',
            'username.required'       => 'Username Wajib Diisi!',
            'username.min'            => 'Username Minimal 3 Karakter!',
            'username.max'            => 'Username Maksimal 50 Karakter!',
            'password.required'       => 'Password Wajib Diisi!',
            'password.min'            => 'Password Minimal 6 Karakter!',
            'password.max'            => 'Password Maksimal 50 Karakter!',
            'password.confirmed'      => 'Password Tidak Sama Dengan Konfirmasi Password!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $user = new Petugas;
        $user->nama_petugas     = $request->nama_petugas;
        $user->avatar           = 'avatar.png';
        $user->username         = Str::lower($request->username);
        $user->password         = Hash::make($request->password);
        $user->role             = 'admin';
        $simpan                 = $user->save();
 
        if($simpan){
            Session::flash('success', 'Register Akun Administrator berhasil! Silahkan Login');
            return redirect()->route('admin.login');
        } else {
            Session::flash('error', 'Register Gagal! Silahkan Ulangi Beberapa Saat Lagi!');
            return redirect()->route('admin.login');
        }
    }
    // MASYARAKAT REGISTER
    public function register_masyarakat()
    {
        return view('components.user.auth.register');
    }
    public function verify_register_masyarakat(Request $request)
    {
        $rules = [
            'nik'                     => 'required|min:16|unique:masyarakats,nik',
            'nama_lengkap'            => 'required|min:3|max:300',
            'username'                => 'required|min:3|max:50|unique:masyarakats,username',
            'password'                => 'required|min:6|confirmed',
            'telp'                    => 'required|min:10|unique:masyarakats,telp'
        ];
 
        $pesan = [
            'nik.required'            => 'NIK Wajib Diisi!',
            'nik.min'                 => 'NIK Minimal 16 Karakter!',
            'nik.unique'              => 'NIK Sudah Terdaftar!',
            'nama_lengkap.required'   => 'Nama Lengkap Wajib Diisi!',
            'nama_lengkap.min'        => 'Nama Lengkap Minimal 3 Karakter!',
            'nama_lengkap.max'        => 'Nama Lengkap Maksimal 300 Karakter!',
            'username.required'       => 'Username Wajib Diisi!',
            'username.min'            => 'Username Minimal 3 Karakter!',
            'username.max'            => 'Username Maksimal 50 Karakter!',
            'username.unique'         => 'Username Sudah Terdaftar! Silahkan Gunakan Username yang Lain!',
            'password.required'       => 'Password Wajib Diisi!',
            'password.min'            => 'Password Minimal 6 Karakter!',
            'password.confirmed'      => 'Password Tidak Sama Dengan Konfirmasi Password',
            'telp.required'           => 'No Telepon Wajib Diisi!',
            'telp.min'                => 'No Telepon Minimal 10 Digit!',
            'telp.unique'             => 'No Telepon Sudah Terdaftar!'
        ];
 
        $validator = Validator::make($request->all(), $rules, $pesan);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $msyrkt = new Masyarakat;
        $msyrkt->nik              = $request->nik;
        $msyrkt->nama_lengkap     = $request->nama_lengkap;
        $msyrkt->avatar           = 'user.png';
        $msyrkt->username         = Str::lower($request->username);
        $msyrkt->password         = Hash::make($request->password);
        $msyrkt->telp             = $request->telp;
        $simpan                   = $msyrkt->save();
 
        if($simpan){
            Session::flash('success', 'Register Akun Berhasil! Silahkan Login');
            return redirect()->route('user.login');
        } else {
            Session::flash('error', 'Register Akun Gagal! Silahkan Ulangi Beberapa Saat Lagi!');
            return redirect()->route('user.register');
        }
    }
}
