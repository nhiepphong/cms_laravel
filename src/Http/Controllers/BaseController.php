<?php
namespace Nhiepphong\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

use Nhiepphong\Backend\Http\Controllers\ManagerAddController;
use Nhiepphong\Backend\Http\Controllers\ManagerEditController;
use Nhiepphong\Backend\Http\Controllers\ManagerListController;
use Nhiepphong\Backend\Http\Controllers\ManagerDeleteController;

class BaseController extends Controller
{
	public $managerList;
    public $managerDelete;
    public $managerAdd;
    public $managerEdit;

	public function __construct()
    {

        $this->managerList      = new ManagerListController();
        $this->managerAdd       = new ManagerAddController();
        $this->managerEdit      = new ManagerEditController();
    	$this->managerDelete    = new ManagerDeleteController();

    	$controller = request()->segment(2);
        $action = request()->segment(3);
        if(!isset($controller))
        {
            $controller = '';
        }
        if(!isset($action))
        {
            $action = '';
        }
        if(!defined("CONTROLLER"))
        {
	        define('CONTROLLER', $controller);
	        define('ACTION', $action);
    	}

        if($controller == "login" || $controller == "logout")
        {
        	if($controller == "login" && $this->_IsSession())
        	{
        		Redirect::to('admin/dashboard')->send();
        	}
        }
        else
        {
        	$this->checkPermission();
        }
    }

	public function checkPermission()
    {
        if($this->_IsSession()==FALSE)
        {
			Redirect::to('admin/login')->send();
		}
		else
		{
			$uid = Session::get('admin_user_id');
			
			$permissions = explode(',',Session::get('admin_permissions'));
			
			if(!in_array(CONTROLLER, $permissions, true) && $uid != 1)
			{
				if(count($permissions) > 0)
				{
					Redirect::to('admin/login/'.$permissions[0].'/lists')->send();
				}
				else
				{
					Redirect::to('admin/login')->send();
				}
			}
			else
			{
				return TRUE;
			}
		}
    }
    
    public function _IsSession(){
    	
    	if (Session::has('admin_username')) 
    	{
            return TRUE;
        }

        return FALSE;
	}
    
    public function _logout($redirect='admin/login'){
    	
		$this->_log_message();

		Session::forget('admin_fullname');
		Session::forget('admin_username');
		Session::forget('admin_user_id');
		Session::forget('admin_group');
		Session::forget('fields_custom');
		Session::forget('admin_permissions');

		Redirect::to('admin/login')->send();
	}
    
    public function _log_message()
    {
    	$log 			= array();
        $log['user_id'] = Session::get('admin_user_id');
        $log['time'] 	= getNow();
        $log['ip'] 		= getIP();
        $log['link'] 	= full_url();

        if(Session::get('admin_user_id'))
        {
        	DB::table('admin_log')->insert($log);
    	}
	}
    
    public function _checkAuth($uName,$pass)
    {
		// Kiem tra user co trong CSDL hay khong ?
		$user = DB::table('admin_user')->where('username', $uName)->first();
		
		if(!$user)
        {
			return FALSE;
		}
        else
        {
        	if($user->password == md5($pass))
            {
				Session::set("admin_fullname", $user->fullname);
				Session::set("admin_username", $user->username);
				Session::set("admin_user_id", $user->id);
				Session::set("admin_group", $user->group_id);
				Session::set("admin_permissions", $user->permissions);
                Session::save();
                
				$this->_log_message();
                
				return TRUE;
			}
            else
            {
				return FALSE;
			}
		}
	}

}
