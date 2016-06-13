<?php

namespace App\Http\Controllers\Admin;

use Nhiepphong\Backend\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use Response;
use Input;

class DashboardController extends BaseController
{
    //
    public function index()
    {
    	$data = array();
        //return view('backend::index', compact('data'));
    }
}
