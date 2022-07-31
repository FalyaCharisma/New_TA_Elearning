<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create data user
        $userCreate = User::create([
          
            'username'  => 'superadminjuara',
            'password'  => bcrypt('password')
        ]);

        //assign permission to role
        $role = Role::find(6);
        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        //assign role with permission to user
        $user = User::find(102);
        $user->assignRole($role->name);
    }
}
