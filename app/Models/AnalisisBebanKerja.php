<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisBebanKerja extends Model
{
    use HasFactory;
    protected $table = 'analisis_beban_kerja';

    protected $fillable = ['user_id', 'bk_id', 'output', 'volume', 'time_allocated', 'daily_volume', 'daily_time', 'daily_used', 'fte', 'tahun'];

    public function tugasRutin()
    {
        return $this->belongsTo(MasterBebanKerja::class, 'bk_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
