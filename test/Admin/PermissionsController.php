<?php

namespace App\Http\Controllers\Admin;

use Nhiepphong\Backend\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use Response;
use Input;

class PermissionsController extends BaseController
{
    //

    public function index($sort = 'id',$by = 'ASC',$start = 0)
    {
    	/*
       Array Col
       txt: loai, ten hien thi
       link: loai,ten hien thi
       img: loai,ten hien thi, kich thuot, duong dan hinh, array(cac duong dan neu co de sau nay xoa cho de)
       date: loai,ten hien thi, format
       status: loai,ten hien thi
       */
       
        $data['fields'] = array(
                            'id'=>array('txt','ID'),
                            'username'=>array('txt','username',true),
                            'fullname'=>array('txt','fullname',true),
                            'is_active'=>array('status','Status',true)
                            );
        $where = '';

        if(Session::get('admin_user_id') == 1)
            $data['sql'] = "SELECT * FROM np_admin_user ORDER BY ".$sort.' '.$by;
        else    
            $data['sql'] = "SELECT * FROM np_admin_user WHERE id = '".Session::get('admin_user_id')."' ORDER BY ".$sort.' '.$by;
        
        $data['start'] = $start;
        $data['title'] = 'List user admin';
        $data['limit'] = 50;
        $data['table'] = 'np_admin_user';
        $data['sort'] = $sort;
        $data['by'] = $by;
        
        return $this->managerList->index($data);
    }

    public function addData($id = 0)
    {
        $permissions = DB::table('admin_menu')->select('name as k', 'model as v')->get();
        
        $input['fields'] = array(
                                'username'=>array('txt',(object)array('label'=>'User name','value'=>'')),
                                'fullname'=>array('txt',(object)array('label'=>'Full name','value'=>'')),
                                'password'=>array('password',(object)array('label'=>'Password','value'=>'')),
                                //'fullname'=>array('img',(object)array('label'=>'Image','resize'=>true,'value'=>"",'description'=>'Size Full size','config'=>array((object)array('width'=>100,'height'=>100,'dir'=> "uploads/avatar")))),
                                'permissions'=>array('checkbox',(object)array('label'=>'Permissions','value'=>'','valueSource'=>$permissions))
                                );
        $input['table'] = 'np_admin_user';
        $input['title'] = "Administrator - Add Admin";

        return $this->managerAdd->index($input);
    }

    public function editData($id = 0)
    {
        $content = DB::table('admin_user')->where('id', $id)->first();
        $permissions = DB::table('admin_menu')->select('name as k', 'model as v')->get();

        if(count($content) > 0)
        {
            $input['fields'] = array(
                                'username'=>array('txt',(object)array('label'=>'User name','value'=>$content->username)),
                                'fullname'=>array('txt',(object)array('label'=>'Full name','value'=>$content->fullname)),
                                'password'=>array('password',(object)array('label'=>'Password','value'=>$content->password)),
                                'permissions'=>array('checkbox',(object)array('label'=>'Permissions','value'=>$content->permissions,'valueSource'=>$permissions))
                                );   
        }
        else
        {
            Redirect::to('admin/permissions/add')->send();
        }

        $input['table'] = 'admin_user';
        $input['title'] = 'Administrator - Edit admin';
        
        return $this->managerEdit->index($input);
    }

    public function deleteData($id = 0)
    {
        $data['table'] = 'np_admin_user';
        $data['id'] = intval($id);
        $this->managerDelete->index($data);
    }
}
