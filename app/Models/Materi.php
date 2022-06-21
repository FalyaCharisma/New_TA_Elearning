<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mapel', 'kelas', 'judul', 'isi', 'ringkasan', 'siswa', 'user_id', 'link',
    ];

    protected $table = 'materi';

    // link 
    public function getLink($id){
        return $this->where('id',$id)->value('link');
    }

    public function getMapel($id){
        return $this->where('id',$id)->value('mapel');
    }

    public function getJudul($id){
        return $this->where('id',$id)->value('judul');
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function siswas(){
        return $this->hasMany(Siswa::class);
    }
    
    public function tentor()
    {
       return $this->belongsTo(Tentor::class);
    }
}
