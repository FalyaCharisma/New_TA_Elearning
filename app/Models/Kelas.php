<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    public function getName($id){
        return $this->where('id',$id)->value('nama_kelas');
    }

    public function users(){
        return $this->hasMany(User::class);
    }
    
    /**
     * This is For CRUD
     * Mengkaitkan table kelas
     *
     */
    protected $table = 'kelas';

    /**
     * Kelas belongs to Mata Pelajaran - Relationship
     *
     */
    public function mapel()
    {
        return $this
            ->belongsToMany('mataPelajaran')
            ->withTimestamps();
    }
}
