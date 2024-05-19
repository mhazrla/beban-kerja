<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBebanKerja extends Model
{
    use HasFactory;
    protected $table = 'user_beban_kerja';

    protected $fillable = ['user_id', 'is_verified', 'tahun'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
