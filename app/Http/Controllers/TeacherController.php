<?php

namespace App\Http\Controllers;

use App\Model\Qualification;
use App\Model\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function __construct(Teacher $teacher, Qualification $qualification)
    {
        $this->teacher = $teacher;
        $this->qualification = $qualification;
    }
    public function index(){
        $items = $this->teacher->get()->toArray();
        foreach ($items as $key => $item) {
            $qualification = $this->qualification->select('majors')->find($item['qualification_id']);
            $items[$key]['qualification'] = $qualification['majors'];
        }
        return json_encode(['status' => 200, 'message' => 'success', 'data' => $items]);
    }
    public function addTeacher(Request $request){
//        dd($request);
        $explode = explode(',', $request->img);
        $decode = base64_decode($explode[1]);
        if (Str::contains($explode[0], 'jpeg')) {
            $etension = 'jpg';
        } else {
            $etension = 'png';
        }
        $fileName = Str::random() . '.' . $etension;
        $path = public_path() . '/img/' . $fileName;


        $this->teacher->name = $request->name;
        $this->teacher->gender = $request->gender;
        $this->teacher->birthday = $request->birthday;
        $this->teacher->qualification_id = $request->qualifiction_id;
        $this->teacher->phone = $request->phone;
        $this->teacher->address = $request->address;
        $this->teacher->email = $request->email;
        $this->teacher->img = $fileName;
        $this->teacher->save();
        file_put_contents($path, $decode);
        return json_encode(['status' => 200, 'message' => 'success']);
    }
}
