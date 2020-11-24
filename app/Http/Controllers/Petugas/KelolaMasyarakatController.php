<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Masyarakat;
use Cache;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use Response;

class KelolaMasyarakatController extends Controller
{
    public function index()
    {
        $msy = Masyarakat::all();
        return view('components.admin.masyarakat.index', compact('msy'));
    }
    public function store(Request $request)
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
            'password.confirmed'      => 'Password Tidak Sama Dengan Konfirmasi Password!',
            'telp.required'           => 'No Telepon Wajib Diisi!',
            'telp.min'                => 'No Telepon Minimal 10 Digit!',
            'telp.unique'             => 'No Telepon Sudah Terdaftar!'
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()]);
        }
        Masyarakat::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'avatar' => 'user.png',
            'telp' => $request->telp
        ]);
        Session::flash('save', 'Data User / Masyarakat Berhasil Di Simpan!');
        return Response::json(['success' => 'Berhasil']);
    }
    public function update_user(Request $request, $id)
    {
        $rules = [
            'nik'                     => 'required|min:16',
            'nama_lengkap'            => 'required|min:3|max:300',
            'username'                => 'required|min:3|max:50',
            'password'                => 'required|min:6|confirmed',
            'telp'                    => 'required|min:10'
        ];
 
        $pesan = [
            'nik.required'            => 'NIK Wajib Diisi!',
            'nik.min'                 => 'NIK Minimal 16 Karakter!',
            'nama_lengkap.required'   => 'Nama Lengkap Wajib Diisi!',
            'nama_lengkap.min'        => 'Nama Lengkap Minimal 3 Karakter!',
            'nama_lengkap.max'        => 'Nama Lengkap Maksimal 300 Karakter!',
            'username.required'       => 'Username Wajib Diisi!',
            'username.min'            => 'Username Minimal 3 Karakter!',
            'username.max'            => 'Username Maksimal 50 Karakter!',
            'password.required'       => 'Password Wajib Diisi!',
            'password.min'            => 'Password Minimal 6 Karakter!',
            'password.confirmed'      => 'Password Tidak Sama Dengan Konfirmasi Password!',
            'telp.required'           => 'No Telepon Wajib Diisi!',
            'telp.min'                => 'No Telepon Minimal 10 Digit!'
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()]);
        }

        $msy = Masyarakat::where('id', $id)->first();
        $data = [
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'avatar' => 'user.png',
            'telp' => $request->telp,
            'remember_token' => Str::random(40)
        ];
        $act = $msy->update($data);
        Session::flash('save', 'Data User / Masyarakat Berhasil Di Update!');
        return Response::json(['success' => 'Berhasil']);
    }
    public function delete_user(Request $request, $id)
    {
        $msy = Masyarakat::where('id', $request->id)->first();
        $act = $msy->delete();
        if($act)
        {
            Session::flash('save', 'Data User / Masyarakat Berhasil Di Hapus!');
            return redirect()->route('kelola_masyarakat');
            echo "sukses";
            //}
        }
        else 
        {
            Session::flash('error', 'Data User / Masyarakat Gagal Di Hapus!');
        }
    }
}
