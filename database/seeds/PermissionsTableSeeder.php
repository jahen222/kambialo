<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission list
        Permission::create(['name' => 'index']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'show']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'store']);
        Permission::create(['name' => 'destroy']);

        //Admin
        $admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'index',
            'edit',
            'update',
            'show',
            'create',
            'store',
            'destroy'
        ]);

        $user = Role::create(['name' => 'User']);

        $user->givePermissionTo([
            'index',
            'edit',
            'update',
            'show',
            'create',
            'store',
            'destroy'
        ]);

        $guest = Role::create(['name' => 'Guest']);

        $guest->givePermissionTo([
            'index',
            'show',
        ]);

        //User Admin
        $user = User::find(1); //Italo Morales
        $user->assignRole('Admin');
    }
}
