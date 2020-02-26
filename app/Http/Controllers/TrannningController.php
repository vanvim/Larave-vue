<?php

namespace App\Http\Controllers;

use App\FileUpload;
use App\Model\ClassRoom;
use App\Model\Course;
use App\Model\Teacher;
use Illuminate\Http\Request;

class TrannningController extends Controller
{
    public function __construct(ClassRoom $class, Teacher $teacher, Course $course,FileUpload $upload)
    {
        $this->class = $class;
        $this->teacher = $teacher;
        $this->course = $course;
        $this->upload = $upload;
    }

    public function index(){
        $class = $this->class->limit(3)->get();
        $upload = $this->upload->get();
        $courses = $this->course->limit(3)->get();
        return view('welcome',
            array(
                'items' => $class,
                'upload' => $upload,
                'courses'=> $courses,
                'class'=> $class,
            ));
    }
}
