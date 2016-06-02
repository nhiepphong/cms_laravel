<?php

namespace Nhiepphong\Backend\Http\Controllers;

use Nhiepphong\Backend\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class ModuleController extends BaseController
{
    public static function menu()
    {
    	$module = new ModuleController();
    	$data = $module->_fetchMenu();
    	
    	return view('backend::includes.menu', compact('data'));
    }

    function _fetchMenu($id = 0)
    {
		if(Session::get('admin_user_id') == 1)
		{
			$data = DB::table('admin_menu')
					->where('is_active', '1')
					->where('parent_id', $id)
					->orderBy('p_order', 'ASC')
					->get();
		}
		else
		{
			$admin_permissions = explode(",", Session::get('admin_permissions'));
			$data = DB::table('admin_menu')
					->where('is_active', '1')
					->where('parent_id', $id)
					->whereIn('model', $admin_permissions)
					->orderBy('p_order', 'ASC')
					->get();
		}
        
        $data = json_decode(json_encode($data), true);

		if(count($data) > 0)
        {
            $i = 0;
            foreach($data as $dt)
            {
                $data[$i]['sub'] = $this->_fetchMenu($dt['id']);
                $i++;
            }
        }
        return $data;
    }
}
