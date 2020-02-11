<?php

namespace App\Http\Controllers;

use App\Model\ClassRoom;
use App\Model\Course;
use App\Model\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function __construct(ClassRoom $class, Teacher $teacher, Course $course)
    {
        $this->class = $class;
        $this->teacher = $teacher;
        $this->course = $course;
    }
    public function index(){
        $items = $this->class->get()->toArray();
        foreach ($items as $key => $item) {
            $teacher = $this->teacher->select('name')->find($item['teacher_id']);
            $course = $this->course->select('name')->find($item['course_id']);
            $items[$key]['teacher'] = $teacher['name'];
            $items[$key]['course'] = $course['name'];
        }
        return json_encode(['status' => 200, 'message' => 'success', 'data' => $items]);
    }
    public function addClass(Request $request){
        $this->class->name = $request->name;
        $this->class->start_time = $request->start_time;
        $this->class->number = $request->number;
        $this->class->schedule = $request->schedule;
        $this->class->course_id = $request->course_id;
        $this->class->teacher_id = $request->teacher_id;

        $this->class->save();

        return json_encode(['status' => 200, 'message' => 'success']);
    }
    public function editClass(Request $request){
        $class = ClassRoom::find($request->id);
         $class->name = $request->name;
         $class->start_time = $request->start_time;
         $class->number = $request->number;
         $class->schedule = $request->schedule;
         $class->course_id = $request->course_id;
         $class->teacher_id = $request->teacher_id;

         $class->save();

        return json_encode(['status' => 200, 'message' => 'success']);
    }
}
