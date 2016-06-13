<?php

namespace App\Http\Controllers\Admin;

use Nhiepphong\Backend\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use Response;
use Input;

class MemberController extends BaseController
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
                        'id'=>array('link','ID', false, url('admin/member/edit/'),"id"),
                        'full_name'=>array('txt','Full Name',true),
                        'name'=>array('txt','Name',true),
                        'google_id'=>array('txt','google id',true),
                        'email'=>array('txt','email',true),
                        'is_remove_banner'=>array('status','remove banner',true),
                        'is_buy_unlimited'=>array('status','buy unlimited',true)
                        );

        $where = 'np_app_users.id > 0';
        
        $data['sql'] = "SELECT * FROM np_app_users WHERE ".$where." ORDER BY ".$sort.' '.$by;
        $data['start'] = $start;
        $data['title'] = 'List Banner';
        $data['limit'] = 10;
        $data['table'] = 'np_app_users';
        $data['sort'] = $sort;
        $data['by'] = $by;

        return $this->managerList->index($data);
    }

    public function addData($id = 0)
    {
        $permissions = $this->base_model->fetch('name as k,model as v','admin_menu');
        
        $input['fields'] = array(
                                'username'=>array('txt',(object)array('label'=>'User name','value'=>'')),
                                'fullname'=>array('txt',(object)array('label'=>'Full name','value'=>'')),
                                'password'=>array('password',(object)array('label'=>'Password','value'=>'')),
                                'permissions'=>array('checkbox',(object)array('label'=>'Permissions','value'=>'','valueSource'=>$permissions))
                                );
        $input['table'] = 'admin_user';
        $input['title'] = "Administrator - Add admin";

        $this->managerAdd->index($input);
    }
}
