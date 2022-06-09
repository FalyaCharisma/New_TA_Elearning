<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;
     /**
     * guarded
     *
     * @var array
     */
    protected $fillable = ['nama_tentor', 'user_id', 'penilaian_id', 'pembelajaran', 'kualitas', 'isi'];

    public function penilaian(){
        return $this->belongsTo(Penilaian::class)->withTimestamps();
    }
    public function user(){
        return $this->belongsTo(User::class);
    } 

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    } 
}
