<?php

namespace App\Http\Controllers;

use App\Model\Course;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function courseDetail($name,$id){
        $courses = $this->course->find($id);
        dd($courses);
    }
}
