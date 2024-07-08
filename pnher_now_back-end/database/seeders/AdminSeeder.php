<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'profile' => 'user.avif'
        ]);
    
        $user = User::create([
            'first_name' => 'Regular',
            'last_name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password')
        ]);
        


        $admin_role = Role::create(['name' => 'admin']);
        $supervisor_role = Role::create(['name' => 'supervisor']);
        $user_role = Role::create(['name' => 'user']);
        $deliverer_role = Role::create(['name' => 'deliverer']);

        $permission = Permission::create(['name' => 'Post access']);
        $permission = Permission::create(['name' => 'Post edit']);
        $permission = Permission::create(['name' => 'Post create']);
        $permission = Permission::create(['name' => 'Post delete']);

        $permission = Permission::create(['name' => 'Role access']);
        $permission = Permission::create(['name' => 'Role edit']);
        $permission = Permission::create(['name' => 'Role create']);
        $permission = Permission::create(['name' => 'Role delete']);

        $permission = Permission::create(['name' => 'User access']);
        $permission = Permission::create(['name' => 'User edit']);
        $permission = Permission::create(['name' => 'User create']);
        $permission = Permission::create(['name' => 'User delete']);

        $permission = Permission::create(['name' => 'Permission access']);
        $permission = Permission::create(['name' => 'Permission edit']);
        $permission = Permission::create(['name' => 'Permission create']);
        $permission = Permission::create(['name' => 'Permission delete']);

        $permission = Permission::create(['name' => 'Mail access']);
        $permission = Permission::create(['name' => 'Mail edit']);


        $permission = Permission::create(['name' => 'Supervisor access']);

        // Company permission
        $permission = Permission::create(['name' => 'Company access']);
        $permission = Permission::create(['name' => 'Company edit']);
        $permission = Permission::create(['name' => 'Company create']);
        $permission = Permission::create(['name' => 'Company delete']);



        $admin->assignRole($admin_role);
        $user->assignRole($user_role);


        $admin_role->givePermissionTo(Permission::all());
    }
}
