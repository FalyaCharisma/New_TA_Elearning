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
   
    public function __construct()
    {
        $this->middleware(['permission:users.index|users.create|users.edit|users.delete|users.tentor|users.siswa|users.showSiswa|users.dataSiswa|users.showTentor|users.dataTentor
        |users.editSiswa']);
    }

    public function index()
    {
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('username', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $roles = new Role();
        $kelas = new Kelas();
        return view('users.index', compact('users','roles', 'kelas'));
    }
    
    public function tentor()
    { 
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('username', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $roles = new Role();
        $tentor = new Tentor();
        return view('users.tentor', compact('users','roles','tentor'));
    }

    public function siswa()
    { 
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('username', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $roles = new Role();
        $siswa = Siswa::latest()->get();
        return view('users.siswa', compact('users','roles','siswa'));
    }

    public function create()
    {
        $roles = Role::latest()->get();
        $kelass = Kelas::latest()->get();
        return view('users.create', compact('kelass','roles'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username'      => 'required',
            'password'  => 'required|confirmed'
        ]);

        $user = User::create([
            'username'  => $request->input('username'),
            'password'  => bcrypt($request->input('password'))
        ]);

        //assign role
        $user->assignRole($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'username'      => 'required',
        ]);

        $user = User::findOrFail($user->id);

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

        //assign role
        $user->syncRoles($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('users.siswa')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.siswa')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function showSiswa($id)
    {
        $tentor = Tentor::latest()->get();
        $user = User::findOrFail($id);
        $siswa = Siswa::latest()->get();

        return view('users.showSiswa', compact('user','siswa', 'tentor'));
    }

    public function showTentor($id)
    {
        $user = User::findOrFail($id);
        $tentor = Tentor::where('user_id', $id)->get();

        return view('users.showTentor', compact('user','tentor'));
    }

    public function dataSiswa(Request $request,$id){
    
        $siswa = Siswa::create([
            'user_id'   => $id,
            'name'      => $request->input('name'),
            'jenjang'   => $request->input('jenjang'),
            'no_wa'     => $request->input('no_wa'),
            'asal_sekolah'    => $request->input('asal_sekolah'),
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

    public function edittTentor($id){ 
        $tentor = Tentor::findOrFail($id);
        $user = User::latest()->get();
        return view('users.edittTentor', compact('tentor','user'));
    }
    public function updateTentor(Request $request, $id){ 
        $tentor = Tentor::find($id)->update($request->all());
        return redirect()->route('users.tentor')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function edittSiswa($id){ 
        $siswa = Siswa::findOrFail($id);
        $user = User::latest()->get();
        $tentor = Tentor::latest()->get();
        $roles = Role::latest()->get();
        return view('users.edittSiswa', compact('tentor','user','siswa','roles'));
    }
    public function updateSiswa(Request $request, $id){ 
        $siswa = Siswa::find($id)->update($request->all());
        return redirect()->route('users.siswa')->with(['success' => 'Data Berhasil Diupdate!']);
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
