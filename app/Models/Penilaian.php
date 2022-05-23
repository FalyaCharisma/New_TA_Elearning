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

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function evaluasis(){
        return $this->hasMany(Evaluasi::class);
    }

}
