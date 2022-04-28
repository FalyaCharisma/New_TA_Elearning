<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'isi_informasi',
    ];

    /**
     * This is For CRUD
     * Mengkaitkan table materi
     *
     */
    protected $table = 'informasi';
    
}
