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
}
