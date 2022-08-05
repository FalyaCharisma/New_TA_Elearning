<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function exams(){
       return $this->belongsToMany(Exam::class)->withPivot('history_answer', 'score')->withTimestamps();
    }

    public function evaluasis(){
        return $this->belongsToMany(Evaluasi::class);
     } 
    public function getName($id){
        return $this->where('id',$id)->value('username');
    }

    public function getScore($user_id, $exam_id){
        return $this->find($user_id)
                    ->exams
                    ->find($exam_id)
                    ->pivot
                    ->score;
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    protected $table = 'users';

    public function mapelUser()
    {
        return $this
            ->belongsToMany(mataPelajaran::class)
            ->withTimestamps();
    }

    public function siswa()
    {
    	return $this->hasOne(Siswa::class);
    }

    public function tentor()
    {
    	return $this->hasOne(Tentor::class);
    }
    public function admin()
    {
    	return $this->hasOne(Admin::class);
    }
}
