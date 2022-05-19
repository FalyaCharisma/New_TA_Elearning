<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalPenilaian extends Model
{
    use HasFactory;
     /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    public function penilaian(){
        return $this->belongsToMany(Penilaian::class)->withTimestamps();
    }
}
