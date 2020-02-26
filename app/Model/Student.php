<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    public $timestamps = false;
    protected $fillable = ['id','name','gender','phone','email','address','birthday','img','class_id'];

    public function class(){
        return $this->belongsTo('App\Model\ClassRoom','class_id','id');
    }

    public function pay(){
        return $this->hasMany('App\Model\Pay','student_id','id');
    }
}
