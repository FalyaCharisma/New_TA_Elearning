<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'mapel', 'kelas', 'judul', 'isi', 'kesimpulan', 'keterangan', 'user_id_teacher',
    ];

    /**
     * This is For CRUD
     * Mengkaitkan table materi
     *
     */
    protected $table = 'materi';
}
