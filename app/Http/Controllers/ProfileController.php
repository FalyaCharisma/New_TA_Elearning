<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Kelas; 
class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:profile.index|profile.create|profile.delete|profile.edit']);
    }

    public function index(){
        $user = User::where('id',Auth::user()->id)->first();
        $kelass = Kelas::latest()->get();
        return view('profile.index', compact('user', 'kelass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$user->id
        ]);

        $user = User::findOrFail($user->id);

        if($request->input('password') == "") {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'kelas'     => $request->input('kelas'),
                'alamat'    => $request->input('alamat'),
                'no_wa'     => $request->input('no_wa'),
                'tgl_lahir' => $request->input('tgl_lahir')
            ]);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'kelas'     => $request->input('kelas'),
                'alamat'    => $request->input('alamat'),
                'no_wa'     => $request->input('no_wa'),
                'tgl_lahir' => $request->input('tgl_lahir'),
                'password'  => bcrypt($request->input('password'))
            ]);
        }
    }

}
