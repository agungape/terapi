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

        Permission::create(['name' => 'create user anak', 'menu_id' => 2]);
        Permission::create(['name' => 'create user terapis', 'menu_id' => 2]);

        Permission::create(['name' => 'view manajemen menu']);

        Permission::create(['name' => 'view anak', 'menu_id' => 1]);
        Permission::create(['name' => 'create anak', 'menu_id' => 1]);
        Permission::create(['name' => 'update anak', 'menu_id' => 1]);
        Permission::create(['name' => 'delete anak', 'menu_id' => 1]);
        Permission::create(['name' => 'show anak', 'menu_id' => 1]);

        Permission::create(['name' => 'view terapis', 'menu_id' => 1]);
        Permission::create(['name' => 'create terapis', 'menu_id' => 1]);
        Permission::create(['name' => 'update terapis', 'menu_id' => 1]);
        Permission::create(['name' => 'delete terapis', 'menu_id' => 1]);
        Permission::create(['name' => 'show terapis', 'menu_id' => 1]);

        Permission::create(['name' => 'view program anak', 'menu_id' => 1]);
        Permission::create(['name' => 'create program anak', 'menu_id' => 1]);
        Permission::create(['name' => 'delete program anak', 'menu_id' => 1]);

        Permission::create(['name' => 'view pelatihan', 'menu_id' => 1]);
        Permission::create(['name' => 'create pelatihan', 'menu_id' => 1]);
        Permission::create(['name' => 'update pelatihan', 'menu_id' => 1]);
        Permission::create(['name' => 'delete pelatihan', 'menu_id' => 1]);

        Permission::create(['name' => 'view rekapan kas', 'menu_id' => 3]);

        Permission::create(['name' => 'view pemasukkan', 'menu_id' => 3]);
        Permission::create(['name' => 'create pemasukkan', 'menu_id' => 3]);
        Permission::create(['name' => 'delete pemasukkan', 'menu_id' => 3]);

        Permission::create(['name' => 'view pengeluaran', 'menu_id' => 3]);
        Permission::create(['name' => 'create pengeluaran', 'menu_id' => 3]);
        Permission::create(['name' => 'delete pengeluaran', 'menu_id' => 3]);

        Permission::create(['name' => 'view kategori', 'menu_id' => 3]);
        Permission::create(['name' => 'create kategori', 'menu_id' => 3]);
        Permission::create(['name' => 'delete kategori', 'menu_id' => 3]);

        Permission::create(['name' => 'view observasi']);
        Permission::create(['name' => 'view pendaftaran']);
        Permission::create(['name' => 'view rekammedis']);
        Permission::create(['name' => 'show rekammedis']);
        Permission::create(['name' => 'view profile']);

        Permission::create(['name' => 'view jadwal anak']);
        Permission::create(['name' => 'create jadwal anak']);
        Permission::create(['name' => 'delete jadwal anak']);


        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $terapisRole = Role::create(['name' => 'terapis']);
        $anakRole = Role::create(['name' => 'anak']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        $superAdminUser = User::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'name' => 'Super Admin',
            'username' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('Bright@0125'),
        ]);

        $superAdminUser->assignRole($superAdminRole);
    }
}
