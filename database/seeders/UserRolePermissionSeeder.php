<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create(['name' => 'master data']);
        Menu::create(['name' => 'manajemen user']);
        Menu::create(['name' => 'keuangan']);

        // Create Permission
        Permission::create(['name' => 'view role', 'menu_id' => 2]);
        Permission::create(['name' => 'create role', 'menu_id' => 2]);
        Permission::create(['name' => 'update role', 'menu_id' => 2]);
        Permission::create(['name' => 'delete role', 'menu_id' => 2]);

        Permission::create(['name' => 'view permission', 'menu_id' => 2]);
        Permission::create(['name' => 'create permission', 'menu_id' => 2]);
        Permission::create(['name' => 'update permission', 'menu_id' => 2]);
        Permission::create(['name' => 'delete permission', 'menu_id' => 2]);

        Permission::create(['name' => 'view user', 'menu_id' => 2]);
        Permission::create(['name' => 'create user', 'menu_id' => 2]);
        Permission::create(['name' => 'update user', 'menu_id' => 2]);
        Permission::create(['name' => 'delete user', 'menu_id' => 2]);

        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $terapisRole = Role::create(['name' => 'terapis']);
        $anakRole = Role::create(['name' => 'anak']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create role', 'view role', 'update role']);
        $adminRole->givePermissionTo(['create permission', 'view permission']);
        $adminRole->givePermissionTo(['create user', 'view user', 'update user']);


        // Let's Create User and assign Role to it.

        $superAdminUser = User::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'name' => 'Super Admin',
            'username' => 'super',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $superAdminUser->assignRole($superAdminRole);


        $adminUser = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $adminUser->assignRole($adminRole);


        $terapisUser = User::firstOrCreate([
            'email' => 'terapis@gmail.com',
        ], [
            'name' => 'terapis',
            'username' => 'terapis',
            'email' => 'terapis@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $terapisUser->assignRole($terapisRole);

        $anakUser = User::firstOrCreate([
            'email' => 'anak@gmail.com',
        ], [
            'name' => 'anak',
            'username' => 'anak',
            'email' => 'anak@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $anakUser->assignRole($anakRole);
    }
}
