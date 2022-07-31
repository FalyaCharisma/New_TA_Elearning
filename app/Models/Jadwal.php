<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = ['nama_siswa', 'hari','jam_masuk','jam_pulang','senin','selasa','rabu','kamis','jumat','sabtu','minggu'];

    protected $casts = [
        'senin' => 'array',
        'selasa' => 'array',
        'rabu' => 'array',
        'kamis' => 'array',
        'jumat' => 'array',
        'sabtu' => 'array',
        'minggu' => 'array'
        // ...
    ];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    } 
}
