<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Siswa; 
use App\Models\Tentor; 
class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:profile.index|profile.create|profile.delete|profile.edit|profile.editTentor']);
    }

    public function index(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where('id',Auth::user()->id)->first();

        if($request->input('password') == "") {
            $user->update([
                'username'  => $request->input('username'),
            ]);
        } else {
            $user->update([
                'username'  => $request->input('username'),
                'password'  => bcrypt($request->input('password'))
            ]);
        }
        $user->update();

        return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function editSiswa(Request $request){ 
        $user = User::where('id',Auth::user()->id)->first();
        $siswa = Siswa::where('user_id', $id)->get();
        return view('profile.editSiswa', compact('user','siswa'));
    }
    public function siswaUpdate(Request $request, $id){ 
        $siswa = Siswa::find($id)->update($request->all());
        return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function editTentor(Request $request){ 
        $user = User::where('id',Auth::user()->id)->first();
        $tentor = Tentor::where('user_id', $id)->get();
        return view('profile.editTentor', compact('user','tentor'));
    }
    public function tentorUpdate(Request $request, $id){ 
        $tentor = Tentor::find($id)->update($request->all());
        return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

}
