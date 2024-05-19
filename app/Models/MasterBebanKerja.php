<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBebanKerja extends Model
{
    use HasFactory;
    protected $table = 'master_beban_kerja';

    protected $fillable = ['name', 'tugas_rutin'];

    public function beban_kerja()
    {
        return $this->hasMany(AnalisisBebanKerja::class);
    }
}
