<?php

namespace Nhiepphong\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Requests;

class CropImageController extends Controller
{
    public function index()
    {
    	$data = array();
        $data['width']  = Input::get("w");
        $data['height'] = Input::get("h");
        $data['link']   = Input::get("link");
        $data['name']   = Input::get("name");

    	return view('backend::crop_image')->with($data);
    }
}
