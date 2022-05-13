<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respon extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'diskusi_id', 'respon'];

    public function diskusi(){
        return $this->belongsTo(Diskusi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
