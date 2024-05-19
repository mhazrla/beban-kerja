<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterBebanKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_beban_kerja')->insert([
            [
                'name' => 'Memproses usulan',
                'tugas_rutin' => 'Kenaikan pangkat tenaga kependidikan (draft surat pengantar dan kelengkapan berkas)',
            ],
            [
                'name' => 'Memproses usulan',
                'tugas_rutin' => 'Kenaikan Gaji Berkala PNS',
            ],
            [
                'name' => 'Memproses usulan',
                'tugas_rutin' => 'Kenaikan pangkat tenaga kependidikan (draft surat pengantar dan kelengkapan berkas)',
            ],
            [
                'name' => 'Memproses usulan',
                'tugas_rutin' => 'Kenaikan pangkat tenaga kependidikan (draft surat pengantar dan kelengkapan berkas)',
            ],
            [
                'name' => 'Memproses usulan',
                'tugas_rutin' => 'Kenaikan pangkat tenaga kependidikan (draft surat pengantar dan kelengkapan berkas)',
            ],
            [
                'name' => 'Memproses usulan',
                'tugas_rutin' => 'Kenaikan pangkat tenaga kependidikan (draft surat pengantar dan kelengkapan berkas)',
            ],
            [
                'name' => 'Memproses usulan',
                'tugas_rutin' => 'Kenaikan pangkat tenaga kependidikan (draft surat pengantar dan kelengkapan berkas)',
            ],
            [
                'name' => 'Memproses usulan',
                'tugas_rutin' => 'Kenaikan pangkat tenaga kependidikan (draft surat pengantar dan kelengkapan berkas)',
            ],
        ]);
    }
}
