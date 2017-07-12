<?php

namespace Nhiepphong\Backend\Http\Controllers;

use Nhiepphong\Backend\Http\Controllers\BaseController;

use Illuminate\Http\Request;

use App\Http\Requests;

class BackendController extends BaseController
{
    //
    public function index()
    {
    	$this->check();
    	$data = array();
    	return view('backend::index', compact('data'));
    }
}
