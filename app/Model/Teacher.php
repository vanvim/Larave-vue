<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $table = 'teacher';
    public $timestamps = false;

    public function class(){
        return $this->hasMany('App\Model\ClassRoom','teacher_id','id');
    }

    public function qualification(){
        return $this->belongsToMany('App\Model\Qualificaltion','id','qualification_id');
    }
}
