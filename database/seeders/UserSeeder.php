<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadminRole = Role::where('name', 'Superadmin')->first();
        $verifikatorRole = Role::where('name', 'Verifikator')->first();
        $pegawaiRole = Role::where('name', 'Administrasi Keuangan')->first();

        DB::table('users')->insert([
            [
                'name' => 'Superadmin',
                'contact' => '123456',
                'role_id' => $superadminRole->id,
                'username' => 'superadmin',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Verifikator',
                'contact' => '123456',
                'role_id' => $verifikatorRole->id,
                'username' => 'verifikator',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pegawai',
                'contact' => '123456',
                'role_id' => $pegawaiRole->id,
                'username' => 'pegawai',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
