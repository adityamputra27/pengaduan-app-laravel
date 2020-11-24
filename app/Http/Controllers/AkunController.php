<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Masyarakat;
use Illuminate\Support\Facades\Hash;
use Session;

class AkunController extends Controller
{
    public function edit($id)
    {
    	$result = Masyarakat::first();
    	return view('components.user.edit-profile', compact('result'));
    }
    public function update(Request $request, $id)
    {
    	$rules = [
    		'nik' => 'required | min : 16',
            'nama_lengkap' => 'required | max : 500',
            'username' => 'required | max : 50',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ];
        $this->validate($request, $rules);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $result = Masyarakat::where('id', $id)->first();
        if ($files = $request->file('avatar')) {
           $destinationPath = 'assets/uploads/'; // upload path
           $fileName = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $fileName);
           $input['avatar'] = $fileName;
        }

        $status = $result->update($input);

        if ($status){
            Session::flash('save', 'Profile Anda Berhasil Di Update!');
            return redirect()->route('profile_masyarakat', Auth()->guard('masyarakat')->user()->id);
        } else {
            return redirect()->route('profile_masyarakat', Auth()->guard('masyarakat')->user()->id);
        }
    }
}
