<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{

    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'get content']);
        Permission::create(['name' => 'getbyid content']);
        Permission::create(['name' => 'post content']);
        Permission::create(['name' => 'update content']);
        Permission::create(['name' => 'delete content']);

        $roleuser = Role::create(['name' => 'user']);
        $roleuser->givePermissionTo('get content');
        $roleuser->givePermissionTo('getbyid content');
        $roleuser->givePermissionTo('update content');

        $rolesuadmin = Role::create(['name' => 'super-admin']);
        $rolesuadmin->givePermissionTo('get content');
        $rolesuadmin->givePermissionTo('getbyid content');
        $rolesuadmin->givePermissionTo('post content');
        $rolesuadmin->givePermissionTo('update content');
        $rolesuadmin->givePermissionTo('delete content');

        $suadmin = User::create([
            'username' => 'super admin',
            'password' => Hash::make('s7QGN50zLY')
        ]);
        $suadmin->assignRole('super-admin');
    }
}
