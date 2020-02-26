<?php

namespace App\Http\Controllers;

use App\Model\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $explode = explode(',', $request->img);
        $decode = base64_decode($explode[1]);
        if (Str::contains($explode[0], 'jpeg')) {
            $etension = 'jpg';
        } else {
            $etension = 'png';
        }
        $fileName = Str::random() . '.' . $etension;
        $path = public_path() . '/img/' . $fileName;
        $this->course->name = $request->name;
        $this->course->date_training = $request->date_training;
        $this->course->tuition = $request->tuition;
        $this->course->tuition = $fileName;

        $this->course->save();

        return json_encode(['status' => 200, 'message' => 'success']);
    }
    public function editCourse(Request $request){
        $explode = explode(',', $request->img);
        $decode = base64_decode($explode[1]);
        if (Str::contains($explode[0], 'jpeg')) {
            $etension = 'jpg';
        } else {
            $etension = 'png';
        }
        $fileName = Str::random() . '.' . $etension;
        $path = public_path() . '/img/' . $fileName;
        $course = Course::find($request->id);
        $course->name = $request->name;
        $course->date_training = $request->date_training;
        $course->tuition = $request->tuition;
        $course->img = $fileName;
        $course->save();

        return json_encode(['status' => 200, 'message' => 'success']);
    }
    public function deleteCourse(Request $request){
        $course = Course::find($request->id);
        $course->delete();
        return json_encode(['status' => 200, 'message' => 'success']);
    }
}
