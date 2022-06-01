<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentor extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'name',
        'no_wa',
        'alamat',
    ];

    protected $table = 'tentors';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function siswa(){
        return $this->hasMany(Siswa::class);
    } 

    public function diskusi(){
        return $this->hasMany(Diskusi::class);
    } 

    public function respon(){
        return $this->hasMany(Respon::class);
    } 
}
