<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware(['permission:profile.index|profile.create|profile.delete|profile.edit']);
    }

    public function index(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'name'      => 'required',
        // ]);

        $user = User::where('id',Auth::user()->id)->first();

        if($request->input('password') == "") {
            $user->update([
                'username'  => $request->input('username'),
                'email'     => $request->input('email'),
            ]);
        } else {
            $user->update([
                'username'  => $request->input('username'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password'))
            ]);
        }
        $user->update();

        return redirect()->route('dashboard.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

}
