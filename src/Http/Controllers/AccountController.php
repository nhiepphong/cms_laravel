<?php

namespace Nhiepphong\Backend\Http\Controllers;

use Nhiepphong\Backend\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class AccountController extends BaseController
{
	public function index()
	{

	}
    //
    public function login()
    {
        $data = array();
        $message = "";

        $pass = false;
        
        if(Input::get("submit"))
        {
            $message = "Enter username and password";

            $rules = array(
                'username'    => 'required',
                'password' => 'required'
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make(Input::all(), $rules);

            // if the validator fails, redirect back to the form
            if ($validator->fails()) 
            {
                $message = "Username and password incorrect";
            } 
            else 
            {
                // create our user data for the authentication
                $userdata = array(
                    'username'     => Input::get('username'),
                    'password'  => Input::get('password')
                );

                if($this->_checkAuth($userdata['username'],$userdata['password']))
                {
                    $pass = true;    
                }
                else
                {
                    $message = "Username and password incorrect";
                }
            }
        }
        
        if($pass)
        {
            if($this->_IsSession())
            {
               return Redirect::to('admin/dashboard');
            }  
        }
        else
        {
            return view('backend::login', compact('data'), compact('message'));
        }
    }

    public function logout()
    {
        $this->_logout();
    }
}
