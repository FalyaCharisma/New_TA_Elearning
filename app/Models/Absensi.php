<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    
    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    public function getLink($id){
        return $this->where('id',$id)->value('link');
    }
}
