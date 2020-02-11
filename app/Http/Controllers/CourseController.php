<?php

namespace App\Http\Controllers;

use App\Model\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(Course $course)
    {
        $this->course = $course;
    }
    public function index(){
        $items = $this->course->get()->toArray();
        return json_encode(['status' => 200, 'message' => 'success', 'data' => $items]);
    }

    public function addCourse(Request $request){
        $this->course->name = $request->name;
        $this->course->date_training = $request->date_training;
        $this->course->tuition = $request->tuition;

        $this->course->save();

        return json_encode(['status' => 200, 'message' => 'success']);
    }
    public function editCourse(Request $request){
        $course = Course::find($request->id);
        $course->name = $request->name;
        $course->date_training = $request->date_training;
        $course->tuition = $request->tuition;
        $course->save();

        return json_encode(['status' => 200, 'message' => 'success']);
    }
}
