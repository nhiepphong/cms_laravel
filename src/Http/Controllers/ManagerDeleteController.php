<?php
namespace Nhiepphong\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class ManagerDeleteController extends Controller
{
    public $table;
    public $img;
    public $id;

    public function index($data = '', $is_auto_redirect = true)
    {
        
       $this->table = $data['table'];
        if(isset($data['img']) && !empty($data['img']))
        {
            $this->img = $data['img'];   
        }
        $this->id = $data['id'];
        
        $dt = DB::table($this->getTableNoPrefix($this->table))->where('id', $this->id)->get();

        if(count($dt) > 0)
        {
            $this->clearImg($dt[0]);
            $this->delete();
        }
        
        if($is_auto_redirect)
        {
            if (url()->previous() != request()->fullUrl())
            {
                Redirect::back()->send();
            }
            else
            {
                Redirect::to('admin/'.CONTROLLER.'/lists')->send();
            }
        }
    }
    
    function clearImg($data)
    {
        if(count($this->img) > 0)
        {
            foreach($this->img as $image)
            {
                if(!empty($data->$image[0]))
                {
                    @unlink($image[1].$data->$image[0]);   
                }
            }
        }
    }
    
    function delete()
    {
        DB::table($this->getTableNoPrefix($this->table))->where('id', $this->id)->delete();
    }

    private function getTableNoPrefix($table_name = "")
    {
        return str_replace("np_", "", $table_name);
    }
}
