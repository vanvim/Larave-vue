<?php

namespace App\Http\Controllers;

use App\Model\ClassRoom;
use App\Model\Course;
use App\Model\Teacher;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(ClassRoom $class, Teacher $teacher, Course $course)
    {
        $this->class = $class;
        $this->teacher = $teacher;
        $this->course = $course;
    }
}
