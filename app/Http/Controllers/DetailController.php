<?php

namespace App\Http\Controllers;

use App\Model\ClassRoom;
use App\Model\Course;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function __construct(Course $course, ClassRoom $class)
    {
        $this->course = $course;
        $this->class = $class;
    }

    public function courseDetail($id){
        $courses = $this->course->find($id);
        $class = $this->class->where('course_id',$id);
        return view('user.detail.course',array(
            'courses' => $courses,
            'class' => $class,
        ));
    }
}
