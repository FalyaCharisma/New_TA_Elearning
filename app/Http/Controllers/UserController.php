<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Tentor;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:users.index|users.create|users.edit|users.delete|users.tentor|users.siswa|users.showSiswa|users.dataSiswa|users.showTentor|users.dataTentor']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $roles = new Role();
        $kelas = new Kelas();
        return view('users.index', compact('users','roles', 'kelas'));
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tentor()
    { 
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $roles = new Role();
        $tentor = new Tentor();
        $kelas = new Kelas();
        return view('users.tentor', compact('users','roles', 'kelas','tentor'));
    }

    public function siswa()
    { 
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $roles = new Role();
        $kelas = new Kelas();
        return view('users.siswa', compact('users','roles', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::latest()->get();
        $kelass = Kelas::latest()->get();
        return view('users.create', compact('kelass','roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed'
        ]);

        $user = User::create([
            'username'  => $request->input('username'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password'))
        ]);

        //assign role
        $user->assignRole($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        $kelass = Kelas::latest()->get();
        return view('users.edit', compact('user','kelass','roles'));
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
            'username'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$user->id
        ]);

        $user = User::findOrFail($user->id);

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

        //assign role
        $user->syncRoles($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function showSiswa($id)
    {
        $tentor = Tentor::latest()->get();
        $user = User::findOrFail($id);
        $kelass = Kelas::latest()->get();
        $siswa = Siswa::where('user_id', $id)->get();

        return view('users.showSiswa', compact('user','siswa', 'kelass', 'tentor'));
    }

    public function showTentor($id)
    {
        $user = User::findOrFail($id);
        $tentor = Tentor::where('user_id', $id)->get();

        return view('users.showTentor', compact('user','tentor'));
    }

    public function dataSiswa(Request $request,$id){
    
        $siswa = Siswa::create([
            'user_id'    => $id,
            'name'      => $request->input('name'),
            'kelas'     => $request->input('kelas'),
            'no_wa'     => $request->input('no_wa'),
            'alamat'    => $request->input('alamat'),
            'nama_tentor'=> $request->input('nama_tentor'),
        ]);

        if ($siswa) {
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    
    public function dataTentor(Request $request,$id){
    
        $tentor = Tentor::create([
            'user_id'    => $id,
            'name'      => $request->input('name'),
            'no_wa'     => $request->input('no_wa'),
            'alamat'    => $request->input('alamat'),
        ]);

        if ($tentor) {
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();


        if($user){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
