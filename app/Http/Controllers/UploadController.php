<?php

namespace App\Http\Controllers;

use App\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class UploadController extends Controller
{
    public function __construct(FileUpload $upload)
    {
        $this->upload = $upload;
    }

    public function index(){
        $items = $this->upload->get()->toArray();
        return json_encode(['status' => 200, 'message' => 'success', 'data' => $items]);
    }

    public function addImg(Request $request){
        $explode = explode(',', $request->img);
        $decode = base64_decode($explode[1]);
        if (Str::contains($explode[0], 'jpeg')) {
            $etension = 'jpg';
        } else {
            $etension = 'png';
        }
        $fileName = Str::random() . '.' . $etension;
        $path = public_path() . '/img/' . $fileName;
        file_put_contents($path, $decode);
        $this->upload->image_name =$fileName;
        $this->upload->save();
        return json_encode(['status' => 200, 'message' => 'success']);
    }
}
