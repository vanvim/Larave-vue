<?php

namespace App\Http\Controllers;

use App\Model\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function __construct(Qualification $qualification)
    {
        $this->qualification = $qualification;
    }
    public function index(){
        $items = $this->qualification->get()->toArray();
        return json_encode(['status' => 200, 'message' => 'success', 'data' => $items]);
    }

    public function addQualification(Request $request){
        $this->qualification->majors = $request->majors;
        $this->qualification->competent_units = $request->competent_units;

        $this->qualification->save();

        return json_encode(['status' => 200, 'message' => 'success']);
    }
}
