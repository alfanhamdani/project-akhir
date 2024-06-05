<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Permission::create(['name' => '$daftar_makanan', 'guard_name' => 'web']);
        Permission::create(['name' => '$edit_resto', 'guard_name' => 'web']);
        Permission::create(['name' => '$transaksi', 'guard_name' => 'web']);

        // $daftar_makanan = Permission::create(['name' => 'daftar_makanan']);
        // $edit_resto = Permission::create(['name' => 'edit_resto']);
        // $transaksi = Permission::create(['name' => 'transaksi']);

        $role_superadmin = Role::create(['name' => 'Superadmin']);
        $role_superadmin->syncPermissions(['$daftar_makanan','$edit_resto','$transaksi']);

        $role_admin = Role::create(['name' => 'Admin']);
        $role_admin->syncPermissions(['$transaksi']);

        $akun_superadmin = new User();
        $akun_superadmin->fill([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        $akun_superadmin->save();
        $akun_superadmin->assignRole($role_superadmin);

        $akun_admin = new User();
        $akun_admin->fill([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        $akun_admin->save();
        $akun_admin->assignRole($role_admin);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
