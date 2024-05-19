<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('roles')->insert([
            [
                'name' => 'Superadmin',
            ],
            [
                'name' => 'Verifikator',
            ],
            [
                'name' => 'Administrasi Keuangan',
            ],
            [
                'name' => 'Supervisor Jaminan Mutu',
            ],
            [
                'name' => 'Staff Administrasi',
            ],
            [
                'name' => 'Staff Rekrutmen Pegawai',
            ],
            [
                'name' => 'Staff Staff Pengelolaan Kinerja Karyawan',
            ],
            [
                'name' => 'Supervisor Human Resource',
            ],
        ]);
    }
}
