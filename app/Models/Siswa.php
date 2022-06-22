<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    } 

    public function tentor(){
        return $this->belongsTo(Tentor::class);
    } 

    public function diskusi(){
        return $this->hasMany(Diskusi::class);
    } 

    public function respon(){
        return $this->hasMany(Respon::class);
    } 

}
