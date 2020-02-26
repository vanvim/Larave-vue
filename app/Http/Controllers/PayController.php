<?php

namespace App\Http\Controllers;

use App\Model\ClassRoom;
use App\Model\Pay;
use App\Model\Student;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function __construct(ClassRoom $class,Student $student,Pay $pay)
    {
        $this->class = $class;
        $this->student = $student;
        $this->pay = $pay;
    }
    public function index(){
        $items = $this->pay->get()->toArray();
        foreach ($items as $key => $item){
            $class =  $this->class->select('name')->find($item['class_id']);
            $student =  $this->student->select('name')->find($item['student_id']);
            $items[$key]['class'] =$class['name'];
            $items[$key]['student'] =$student['name'];
        }
        return json_encode(['status' => 200, 'message' => 'success', 'data' => $items]);
    }
    public function addPay(Request $request){
        $this->pay->student = $request->student;
        $this->pay->class = $request->class;
        $this->pay->tuition = $request->tuition;
        $this->pay->sale = $request->sale;
        $this->pay->pay = (int)$request->tuition - (int)$request->sale;
        $this->pay->pay1 = $request->pay1;
        $this->pay->pay2 = $request->pay2;
        $this->pay->rest = (int)$this->pay->pay - (int)$request->pay1-(int)$request->pay2;
        $this->pay->save();

        return json_encode(['status' => 200, 'message' => 'success']);
    }
}
