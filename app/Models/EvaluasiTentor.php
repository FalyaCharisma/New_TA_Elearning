<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiTentor extends Model
{
    use HasFactory;
     /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    public function penilaians(){
        return $this->belongsToMany(Penilaian::class)->withTimestamps();
    }
}
