<?php

namespace App\Http\Controllers;

use App\Model\ClassRoom;
use App\Model\Student;
use App\Model\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function __construct(Student $student, Teacher $teacher, ClassRoom $class)
    {
        $this->student = $student;
        $this->teacher = $teacher;
        $this->class = $class;
    }

    public function index()
    {
        $items = $this->student->get()->toArray();
        foreach ($items as $key => $item) {
            $class = $this->class->select('name')->find($item['class_id'])->toArray();
            $items[$key]['class'] = $class['name'];
        }
        return json_encode(['status' => 200, 'message' => 'success', 'data' => $items]);
    }

    public function addStudent(Request $request)
    {
        if($request->img != ''){
            $explode = explode(',', $request->img);
            $decode = base64_decode($explode[1]);
            if (Str::contains($explode[0], 'jpeg')) {
                $etension = 'jpg';
            } else {
                $etension = 'png';
            }
            $fileName = Str::random() . '.' . $etension;
            $path = public_path() . '/img/' . $fileName;
        }else{
            $fileName ='';
        }


        $this->student->name = $request->name;
        $this->student->gender = $request->gender;
        $this->student->birthday = $request->birthday;
        $this->student->class_id = $request->class_id;
        $this->student->phone = $request->phone;
        $this->student->email = $request->email;
        $this->student->address = $request->address;
        $this->student->img = $fileName;

        $this->student->save();
        if ($request->img != ""){
            file_put_contents($path, $decode);
        }
        return json_encode(['status' => 200, 'message' => 'success']);
    }
    public function editStudent(Request $request)
    {
        if($request->img != ''){
            $explode = explode(',', $request->img);
            $decode = base64_decode($explode[1]);
            if (Str::contains($explode[0], 'jpeg')) {
                $etension = 'jpg';
            } else {
                $etension = 'png';
            }
            $fileName = Str::random() . '.' . $etension;
            $path = public_path() . '/img/' . $fileName;
        }else{
            $fileName ='';
        }


        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->birthday = $request->birthday;
        $student->class_id = $request->class_id;
        $student->phone = $request->phone;
        $student->email = $request->email;
        $student->address = $request->address;
        $student->img = $fileName;

        $student->save();
        if ($request->img != ""){
            file_put_contents($path, $decode);
        }
        return json_encode(['status' => 200, 'message' => 'success']);
    }

    public function deleteStudent(Request $request){
        $student = Student::find($request->id);
        $student->delete();
        return json_encode(['status' => 200, 'message' => 'success']);
    }
}
