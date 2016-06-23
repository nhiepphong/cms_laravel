<?php

namespace Nhiepphong\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nhiepphong\Backend\Libraries\Pagination;
use App\Http\Requests;

class ManagerListController extends Controller
{
    public $table;
    public $fields;
    public $pagination;
    public $is_add;
    public $is_edit;
    public $is_delete;

    public function __construct()
    {
        $this->is_add = true;
        $this->is_edit = true;
        $this->is_delete = true;
        $this->pagination = new Pagination();
    }

    public function index($dt = '')
    {
        if(isset($dt['table']) && !empty($dt['table']))
            $this->table = $dt['table'];
        else
            $this->table = null;
            
        if(isset($dt['fields']) && !empty($dt['fields']))
            $this->fields = $dt['fields'];
        else
            $this->fields = null;
        
        if(isset($dt['sql']) && !empty($dt['sql']))
            $sql = $dt['sql'];
        else
            $sql = '';
        
        if(isset($dt['start']) && !empty($dt['start']))
            $start = $dt['start'];
        else
            $start = 0;
        if(isset($dt['limit']) && !empty($dt['limit']))
            $limit = $dt['limit'];
        else
            $limit = 10;
            
        if(isset($dt['title']) && !empty($dt['title']))
            $title = $dt['title'];
        else
            $title = 'List';
        
        if(Input::get('config'))
        {
            $this->_config();
        }
            
        $sql = $this->_out_sql_for_search($sql);

        $sql_for_count  = $this->parser_sql_for_count($sql);
        $tmp            = DB::select($sql_for_count);
        $num_row        = count($tmp);
        
        if(Input::get('search'))
        {
            if(isset($dt['id_list']))
            {
                Redirect::to('admin/'.CONTROLLER.'/lists/'.$dt['id_list'].'/'.$dt['sort'].'/'.$dt['by'].'/0')->send();
            }
            else
            {
                Redirect::to('admin/'.CONTROLLER.'/lists/'.$dt['sort'].'/'.$dt['by'].'/0')->send();
            }
        }       
        
        if($sql != '')
            $sql .= " LIMIT ".$start.','.$limit;

        $data['data']       = DB::select($sql);
        $data['fields']     = $this->fields;
        $data['title']      = $title;
        $data['title_page'] = 'Showing '.$start.' to '.($start + $limit).' of '.$num_row.' entries';
        
        if(isset($dt['id_list']))
        {
            $data['linkPage'] = $this->_phantrang($num_row,CONTROLLER.'/lists/'.$dt['id_list'].'/'.$dt['sort'].'/'.$dt['by'].'/',7,$limit);
        }
        else
        {
            $data['linkPage'] = $this->_phantrang($num_row,CONTROLLER.'/lists/'.$dt['sort'].'/'.$dt['by'].'/',6,$limit);
        }
        $data['sort'] = $dt['sort'];
        $data['by'] = $dt['by'];
        if(isset($dt['id_list']))
            $data['link'] = url('admin/'.CONTROLLER.'/lists/'.$dt['id_list'].'/');
        else
            $data['link'] = url('admin/'.CONTROLLER.'/lists/');
        $data['start'] = $start;


        if(isset($dt['id_list']))
        {
            $data['id_content'] = $dt['id_list'];
        }
        else
        {
            $data['id_content'] = 0;
        }

        $data['is_add']     = $this->is_add;
        $data['is_edit']    = $this->is_edit;
        $data['is_delete']  = $this->is_delete;
        
        return view('backend::admin_list')->with($data);
    }
    
    function _config()
    {
        $action = Input::get('dropdown');

        $array_id = Input::get('array_id');
        if(substr($array_id,-1) == ',')
        {
            $array_id = substr($array_id,0,-1);
        }
        $array = explode(',',$array_id);
        
        if($action == 2) // DELETE
        {
            $this->_delete($array);
        }
        else if($action == 3) //ACTIVE
        {
            $this->_active($array);
        }
        else if($action == 4) // UNACTIVE
        {
            $this->_unactive($array);    
        }
    }
    
     function _phantrang($num_row,$link,$num_segment,$limit = 10)
    {

        $config['base_url'] = url('admin/'.$link);
        $config['total_rows'] = $num_row;
        $config['per_page'] = $limit;
        $config['uri_segment'] = $num_segment;
        $config['cur_page'] = request()->segment($num_segment);
        
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close']= '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $config['first_tag_open'] = '<li>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = '← Previous';
        $config['prev_tag_close'] = '</li>';
        
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = 'Next → ';
        $config['next_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        
        $linkPage = $this->pagination->create_links();
        
        return $linkPage;
    }
    
    function parser_sql_for_count($sql)
    {
        list($sql1,$sql2) = explode("FROM", $sql);
        
        return "SELECT ".$this->table.".id FROM ".$sql2;
    }
    
    function _out_sql_for_search($sql)
    {
        $sql3 = '';
        $whereFirst = false;
        
        $pos = strpos($sql,'WHERE');        
        if ($pos === false)
        {
            $pos = strpos($sql,'FROM');
            if ($pos === false)
            {
                
            }
            else
            {
                list($sql1,$sql2) = explode("FROM ", $sql);
                
                $pos = strpos($sql2,' ');
                if($pos === false)
                {
                    
                }
                else
                {
                    $tablename = substr($sql2,0,$pos);
                    $a1 = substr($sql2,$pos);
                    $sql1 .= " FROM ".$tablename;
                    $sql2 = $a1;
                }               
            }
        }
        else
        {
            $whereFirst = true;
            list($sql1,$sql2) = explode("WHERE", $sql);    
        }
         
        if(Input::get('search'))
        {
            foreach($_POST as $k => $v)
            {
                if($k != '_token' && $k != 'search' && $v != '')
                {
                    if($k == 'report_tungay')
                    {
                        $sql3 .= '('.$this->table.'.CreatedDate BETWEEN "'.date('Y-m-d',strtotime(Input::get('report_tungay'))).' 00:00:00" AND "'.date('Y-m-d',strtotime(Input::get('report_denngay'))).' 23:59:59") AND ';
                    }
                    else if($k != 'report_denngay')
                    {
                        if(!empty($v))
                        {
                            if(is_numeric($v))
                            {
                                if($k == "is_active")
                                {
                                    $sql3 .= $this->table.'.'.$k.'='.$v.' AND ';
                                }
                                else
                                {
                                    $sql3 .= $k.'='.$v.' AND ';
                                }
                            }
                            else
                            {
                                //$sql3 .= $this->table.'.'.$k.' LIKE "'.$v.'" AND ';    
                                $sql3 .= $k.' LIKE "'.$v.'" AND ';    
                            }
                        }
                    }                   
                }
            }
            if(substr($sql3,-4) == 'AND ')
            {
                $sql3 = substr($sql3,0,-4);
            }
            
            Session::set("admin_sql", $sql3);
            Session::set("admin_table", $this->table);
        }
        else
        {
            if(Session::get('admin_table') != $this->table)
            {
                Session::forget('admin_sql');
                Session::forget('admin_table');
            }
            else
            {
                if(Session::get('admin_sql'))
                {
                    $sql3 = Session::get('admin_sql');  
                }
            }
        }
        if($sql3 != '')
        {
            if($whereFirst)
            {
                $sql = $sql1.' WHERE '.$sql3.' AND '.$sql2;   
            }
            else
            {
                $sql = $sql1.' WHERE '.$sql3.' '.$sql2;
            }
        }
        //echo $sql;exit();
        Session::set('admin_sql_full', $sql);
        return $sql;
    }
    
    function _delete($array_id = '')
    {
        foreach($array_id as $id)
        {
            foreach($this->fields as $k=>$v)
            {
                if($v[0] == 'img')
                {
                    $name = $k;
                    
                    $data = DB::table($this->getTableNoPrefix())->where('id', $id)->first();

                    if(count($data) > 0)
                    {
                        if(!empty($data->$name))
                        {
                            if(isset($v[4]) && count($v[4]) > 0)
                            {
                                foreach($v[4] as $dir)
                                {
                                    @unlink($dir.$data->$name);   
                                }
                            }  
                        }
                    }
                }
            }
            
            DB::table($this->getTableNoPrefix())->where('id', $id)->delete();
        }
    }

    function _active($array_id = '')
    {
        if(count($array_id) > 0)
        {
            foreach($array_id as $id)
            {
                DB::table($this->getTableNoPrefix())->where('id', $id)->update(array('is_active' => 1));
            }
        }
    }
    
    function _unactive($array_id = '')
    {
        if(count($array_id) > 0)
        {
            foreach($array_id as $id)
            {
                DB::table($this->getTableNoPrefix())->where('id', $id)->update(array('is_active' => 0));
            }
        }
    }

    function getTableNoPrefix()
    {
        return str_replace("np_", "", $this->table);
    }
}
