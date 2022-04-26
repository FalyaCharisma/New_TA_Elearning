<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mataPelajaran extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    public function getName($id){
        return $this->where('id',$id)->value('mata_pelajaran');
    }

    /**
     * This is For CRUD
     * Mengkaitkan table mata_pelajaran
     *
     */
    protected $table = 'mata_pelajarans';

    /**
     * Kelas belongs to Mata Pelajaran - Relationship
     *
     */
    public function kelas()
    {
        return $this
            ->belongsToMany(Kelas::class)
            ->withTimestamps();
    }

    /**
     * mataPelajaran belongs to User - Relationship
     *
     */
    public function userMapel()
    {
        return $this
            ->belongsToMany(User::class)
            ->withTimestamps();
    }
}
