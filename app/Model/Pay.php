<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    public $table = 'pay';
    public $timestamps = false;

    public function student(){
        return $this->belongsTo('App\Model\Student','student_id','id');
    }

    public function class(){
        return $this->belongsTo('App\Model\ClassRoom','class_id','id');
    }
}
