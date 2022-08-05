<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Tentor;
use App\Models\Kelas;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   
    public function __construct()
    {
        $this->middleware(['permission:users.index|users.createSiswa|users.edit|users.delete|users.tentor|users.siswa|users.showSiswa|users.dataSiswa|users.showTentor|users.dataTentor
        |users.editSiswa']);
    }

    public function index()
    {
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('username', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::latest()->get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'username'      => 'required',
        //     'password'  => 'required|confirmed'
        // ]);

        // $user = User::create([
        //     'username'      => $request->input('username'),
        //     'password'  => bcrypt($request->input('password'))
        // ]);

        // //assign role
        // $user->assignRole(6);

        // if($user){
        //     //redirect dengan pesan sukses
        //     return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        // }else{
        //     //redirect dengan pesan error
        //     return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        // }
        $data = $request->all();

        $user = new User();
        $user->username = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->save();

        //assign role
        $user->assignRole(1);

        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->name = $data['name'];
        $admin->cabang = $data['cabang'];
        $admin->no_wa = $data['no_wa'];
        $admin->alamat = $data['alamat'];
        $admin->save();

        return redirect()->route('users.admin')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    public function tentor()
    { 
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('username', 'like', '%'. request()->q . '%');
        })->paginate(1000);
        $roles = new Role();
        $tentor = new Tentor();
        return view('users.tentor', compact('users','roles','tentor'));
    }

    public function admin()
    { 
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('username', 'like', '%'. request()->q . '%');
        })->paginate(1000);
        $roles = new Role();
        $admin = Admin::latest()->get();
        return view('users.admin', compact('users','roles','admin'));
    }

    public function siswa()
    { 
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('username', 'like', '%'. request()->q . '%');
        })->paginate(1000);
        $roles = new Role();
        $siswa = Siswa::latest()->get();
        return view('users.siswa', compact('users','roles','siswa'));
    }

    public function createSiswa()
    {
        $roles = Role::latest()->get();
        $kelass = Kelas::latest()->get();
        $tentor = Tentor::latest()->get();
        return view('users.createSiswa', compact('kelass','roles','tentor'));
    }

    public function createAdmin()
    {
        $roles = Role::latest()->get();
        return view('users.createAdmin', compact('roles'));
    }

    public function createTentor()
    {
        $roles = Role::latest()->get();
        return view('users.createTentor', compact('roles'));
    }

    public function store3(Request $request)
    {
        $data = $request->all();

        $user = new User();
        $user->username = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->save();

        //assign role
        $user->assignRole(3);

        $siswa = new Siswa();
        $siswa->user_id = $user->id;
        $siswa->name = $data['name'];
        $siswa->jenjang = $data['jenjang'];
        $siswa->no_wa = $data['no_wa'];
        $siswa->alamat = $data['alamat'];
        $siswa->asal_sekolah = $data['asal_sekolah'];
        $siswa->nama_tentor = $data['nama_tentor'];
        $siswa->cabang = Auth::user()->admin->cabang; 
        $siswa->save();

        return redirect()->route('users.siswa')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function store2(Request $request)
    {
        $data = $request->all();

        $user = new User();
        $user->username = $data['username'];
        $user->password = bcrypt($data['password']);
        $user->save();

        //assign role
        $user->assignRole(2); 

        $tentor = new Tentor();
        $tentor->user_id = $user->id;
        $tentor->name = $data['name'];
        $tentor->no_wa = $data['no_wa'];
        $tentor->alamat = $data['alamat'];
        $tentor->cabang = Auth::user()->admin->cabang; 
        $tentor->save();

        return redirect()->route('users.tentor')->with(['success' => 'Data Berhasil Disimpan!']);
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

        if($user){
            //redirect dengan pesan sukses
            return redirect()->back()->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->back()->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function edittTentor($id){ 
        $tentor = Tentor::findOrFail($id);
        $user = User::latest()->get();
        $roles = Role::latest()->get();
        return view('users.edittTentor', compact('tentor','user','roles'));
    }
    public function updateTentor(Request $request, $id){ 
        $tentor = Tentor::find($id)->update($request->all());
        return redirect()->route('users.tentor')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function edittAdmin($id){ 
        $admin = Admin::findOrFail($id);
        $user = User::latest()->get();
        $roles = Role::latest()->get();
        return view('users.edittAdmin', compact('admin','user','roles'));
    }
    public function updateAdmin(Request $request, $id){ 
        $admin = Admin::find($id)->update($request->all());
        return redirect()->route('users.admin')->with(['success' => 'Data Berhasil Diupdate!']);
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
