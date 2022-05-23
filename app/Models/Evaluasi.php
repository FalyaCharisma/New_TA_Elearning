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
    protected $fillable = ['nama_tentor','nama_siswa', 'penilaian_id', 'pembelajaran', 'kualitas', 'isi'];

    public function penilaians(){
        return $this->belongsTo(Penilaian::class)->withTimestamps();
    }
    public function user(){
        return $this->belongsTo(User::class);
    } 
}
