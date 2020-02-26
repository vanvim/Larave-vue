<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    public $table = 'class';
    public $timestamps = false;

    public function student(){
        return $this->hasMany('App\Models\Student','class_id','id');
    }

    public function course(){
        return $this->belongsTo('App\Models\Course','course_id','id');
    }
    public function teacher(){
        return $this->belongsTo('App\Models\Teacher','teache_id','id');
    }

    public function pay(){
        return $this->hasMany('App\Models\PayMent','class_id','id');
    }
}
