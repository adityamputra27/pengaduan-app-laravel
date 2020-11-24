<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategori;
use Session;
use Illuminate\Support\Facades\Validator;
use Response;

class KelolaKategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('components.admin.kategori.index', compact('kategori'));
    }
    public function store(Request $request)
    {
        $rules = [
            'nama_kategori' => 'required|max:100|unique:kategoris,nama_kategori'
        ];
        $pesan = [
            'nama_kategori.required'     => 'Nama Kategori Wajib Diisi!',
            'nama_kategori.max'     => 'Nama Kategori Maksimal 100 Karakter!',
            'nama_kategori.unique'     => 'Nama Kategori Sudah Ada!',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()]);
        }
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'active' => true
        ]);
        Session::flash('save', 'Kategori Berhasil Di Simpan!');
        return Response::json(['success' => 'Berhasil']);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'nama_kategori' => 'required|max:100'
        ];
        $pesan = [
            'nama_kategori.required'     => 'Nama Kategori Wajib Diisi!',
            'nama_kategori.max'     => 'Nama Kategori Maksimal 100 Karakter!'
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()]);
        }
        $kat = Kategori::where('id_kategori', '=', $request->id_kategori)->first();
        $data = [
            'nama_kategori' => $request->nama_kategori,
            'active' => true
        ];
        $kat->update($data);
        Session::flash('save', 'Kategori Berhasil Di Update!');
        return Response::json(['success' => 'Sukses!']);
    }
    public function destroy(Request $request, $id)
    {
        $kat = Kategori::where('id_kategori', $request->id_kategori);
        $act = $kat->delete();
        if ($act) {
            Session::flash('save', 'Kategori Berhasil Di Hapus!');
            return redirect()->route('kategori');
        }
    }
    public function apply($id)
    {
        $active = Kategori::where('id_kategori', $id)->first();
        $act = ($active->active == true) ? false : true;
        Kategori::where('id_kategori', $id)->update(['active' => $act]);
        Session::flash('save', 'Status Kategori Berhasil Di Update!');
        return redirect('app/kategori');
    }
}
