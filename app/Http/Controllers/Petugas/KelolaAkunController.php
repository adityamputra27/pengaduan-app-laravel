<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Petugas;
use Cache;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use Response;

class KelolaAkunController extends Controller
{
    public function index()
    {
        $user = Petugas::all();
        return view('components.admin.petugas.index', compact('user'));
    }
    public function buat_akun(Request $request)
    {
        $rules = [
            'nama_petugas'          => 'required|min:3',
            'username'              => 'required|min:3|unique:petugas,username',
            'password'              => 'required|min:6|confirmed'
        ];
        $pesan = [
            'nama_petugas.required' => 'Nama Petugas Wajib Di Isi!',
            'nama_petugas.min'      => 'Nama Petugas Minimal 3 Karakter!',
            'username.required'     => 'Username Wajib Di Isi!',
            'username.min'          => 'Username Minimal 3 Karakter!',
            'username.unique'       => 'Username Sudah Terdaftar!',
            'password.min'          => 'Password Minimal 6 Karakter!',
            'password.required'     => 'Password Wajib Di Isi!',
            'password.confirmed'    => 'Password Tidak Sama Dengan Konfirmasi Password!'
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()]);
        }
        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'avatar' => 'avatar.png',
            'telp'  => $request->telp,
            'role' => 'petugas'
        ]);
        Session::flash('save', 'Petugas Berhasil Di Simpan!');
        return Response::json(['success' => 'Berhasil']);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'nama_petugas'          => 'required|min:3',
            'username'              => 'required|min:3',
            'password'              => 'required|min:6|confirmed'
        ];
        $pesan = [
            'nama_petugas.required' => 'Nama Petugas Wajib Di Isi!',
            'nama_petugas.min'      => 'Nama Petugas Minimal 3 Karakter!',
            'username.required'     => 'Username Wajib Di Isi!',
            'username.min'          => 'Username Minimal 3 Karakter!',
            'password.min'          => 'Password Minimal 6 Karakter!',
            'password.required'     => 'Password Wajib Di Isi!',
            'password.confirmed'    => 'Password Tidak Sama Dengan Konfirmasi Password!'
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()]);
        }
        $pet = Petugas::where('id', '=', $request->id)->first();
        $data = [
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'avatar' => 'avatar.png',
            'telp'  => $request->telp
        ];
        $pet->update($data);
        Session::flash('save', 'Petugas Berhasil Di Update!');
        return Response::json(['success' => 'Berhasil']);

    }
    public function delete_petugas(Request $request, $id)
    {
        $petugas = Petugas::where('id', $request->id);
        $act = $petugas->delete();
        if($act)
        {
            Session::flash('save', 'Data Petugas Berhasil Di Hapus!');
            return redirect()->route('petugas_home');
            echo "sukses";
            //}
        }
        else 
        {
            Session::flash('error', 'Data Petugas Gagal Di Hapus!');
        }
    }
    public function history_login()
    {
        $history = Petugas::all();
        return view('components.admin.history_login', compact('history'));
    }
    public function edit_profile($id)
    {
        $result = Petugas::where('id', $id)->first();
        return view('components.admin.edit_profile', compact('result'));
    }
    public function update_profile(Request $request, $id)
    {
        $rules = [
            'nama_petugas' => 'required | max : 500',
            'username' => 'required | max : 500',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ];
        $this->validate($request, $rules);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $result = Petugas::where('id', $id)->first();

        // if ($request->hasFile('avatar')) {
        //     $avatar = $request->file('avatar');
        //     // $filename = $request->file('avatar')->getClientOriginalName();
        //     // $request->file('avatar')->storeAs('', $filename);
        //     // $avatar->move('assets/admin/img/uploads/', $filename);
        //     $filename = time().'.'.$avatar->getClientOriginalName();
        //     $avatar->storeAs('', $filename);
        //     $avatar->move('assets/admin/img/uploads/', $filename);
        // }
        // else
        // {

        // }
        if ($files = $request->file('avatar')) {
           $destinationPath = 'assets/admin/uploads/'; // upload path
           $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $fileName);
           $input['avatar'] = $fileName;
        }

        $status = $result->update($input);

        if ($status){
            Session::flash('save', 'Profile Berhasil Di Update!');
            return redirect()->route('edit_profile', Auth()->guard('petugas')->user()->id);
        } else {
            return redirect()->route('edit_profile', Auth()->guard('petugas')->user()->id);
        }
    }
}
