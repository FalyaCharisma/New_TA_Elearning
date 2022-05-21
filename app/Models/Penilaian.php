<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory; 
    /**
     * guarded
     * 
     * @var array
     */ 
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('riwayat_penilaian', 'nilai')->withTimestamps();
    }

    public function soal_penilaians(){
        return $this->belongsToMany(SoalPenilaian::class)->withTimestamps();
    }

}
