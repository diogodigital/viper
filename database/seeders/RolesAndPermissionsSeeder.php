<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::create(['name' => 'show_admin']);

        // Create roles and assign created permissions
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('show_admin');


        // Assign roles to demo users
        $admin = User::create([
             'name' => 'Admin',
             'last_name' => 'Admin',
             'email' => 'admin@demo.com',
             'role_id' => 0,
             'password' => Hash::make('123456'),
         ]);

        /// criando uma carteira
        Wallet::create([
            'user_id' => 1,
            'balance' => 0
        ]);

        \DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => 1,
        ]);

    }
}
