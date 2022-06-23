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

    protected $table = 'kelas';

    public function mapel()
    {
        return $this
            ->belongsToMany('mataPelajaran')
            ->withTimestamps();
    }
}
