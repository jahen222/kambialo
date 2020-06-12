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
        Permission::create(['name' => 'products.index']);
        Permission::create(['name' => 'product.edit']);
        Permission::create(['name' => 'product.show']);
        Permission::create(['name' => 'product.create']);
        Permission::create(['name' => 'product.destroy']);

        //Admin
        $admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'products.index',
            'product.edit',
            'product.show',
            'product.create',
            'product.destroy'
        ]);
        //$admin->givePermissionTo('products.index');
        //$admin->givePermissionTo(Permission::all());

        //Guest
        $guest = Role::create(['name' => 'Guest']);

        $guest->givePermissionTo([
            'products.index',
            'product.edit',
            'product.show',
            'product.create',
            'product.destroy'
        ]);

        //User Admin
        $user = User::find(1); //Italo Morales
        $user->assignRole('Admin');
    }
}
