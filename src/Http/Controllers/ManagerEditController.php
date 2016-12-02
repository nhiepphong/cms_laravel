<?php
namespace Nhiepphong\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use \Intervention\Image\Facades\Image;

class ManagerEditController extends Controller
{
    public function index($input = '')
    {
        
        Session::forget('admin_sql');
       
        if(Input::get('submit'))
        {
            $this->saveData($input);
        }
        else
        {
            return $this->outHtml($input);
        }
    }

    function saveData($input = '')
    {
        $value = array();
        if(Input::file())
        {
            $this->saveImages($input,$value);   
        }

        foreach($_POST as $k => $v)
        {
            if($k != '_token' && $k != 'submit')
            {
                if(strpos(strtolower($k), "_autocomplete") === false)
                {
                    if(property_exists($input['fields'][$k][1],'noupdate'))
                    {
                    
                    }               
                    else
                    {
                        if(strtolower($k) == 'password')
                        {
                            if(!empty($v))
                                $value[$k] = $this->FilterData($input,$k,$v);
                        }
                        else if(strtolower($k) == 'link_image')
                        {
                            if(!empty($v) && empty($value["image"]))
                                $value["image"] = $this->FilterData($input,$k,$v);
                        }
                        else if($input['fields'][$k][0] == "img" && $input['fields'][$k][1]->resize == true)
                        {
                            if(!empty($v) && $v != "")
                            {
                                $value[$k] = $this->FilterData($input,$k,$v);
                            }
                        }
                        else
                        {
                            $value[$k] = $this->FilterData($input,$k,$v);
                        }
                    }
                }
            }     
        }
        
        if(isset($value['slug']))
        {
            if(isset($input['fields']['slug'][1]->id))
            {
                $value['slug'] = str_slug($value[$input['fields']['slug'][1]->id], "-");
            }
        }
        if(isset($value['tag']))
        {
            $tag = explode(',',$value['tag']);
            if(count($tag) > 0)
            {
                $tag_id = array();
                
                foreach($tag as $ta)
                {
                    $dtag = DB::table($this->getTableNoPrefix('np_tag'))->where('name', $ta)->first();
                    if($dtag)
                    {
                        array_push($tag_id, $dtag->id);
                    }
                    else
                    {
                        $id = DB::table($this->getTableNoPrefix('np_tag'))->insertGetId(array("name"=>$ta));
                        array_push($tag_id, $id);
                    }
                }
                $value['tag'] = implode(",", $tag_id);
            }
        }

        $value['updated_at']= \Carbon\Carbon::now()->toDateTimeString();
        DB::table($this->getTableNoPrefix($input['table']))->where('id', request()->segment(4))->update($value);
        
        //echo "<script>window.history.go(-2);</script>";
        if (url()->previous() != request()->fullUrl())
        {
            Redirect::back()->send();
        }
        else
        {
            Redirect::to('admin/'.CONTROLLER.'/lists')->send();
        }
    }
    
    function saveImages($input,&$value)
    {
        $data = DB::table($this->getTableNoPrefix($input['table']))->where('id', request()->segment(4))->first();
        
        foreach($_FILES as $name=>$file)
        {
            if($file['name'] != '')
            {
                if($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == "image/png" || $file['type'] == "image/gif")
                {
                    $image = Input::file($name);

                    $file_name = $file['name'];
                    $file_name = _upload_file_name($file_name);
                    
                    foreach($input['fields'][$name][1]->config as $config)
                    {
                        $dir = $config->dir;
                        $width = $config->width;
                        $height = $config->height;
                        
                        if($width == 0 && $height == 0)
                        {
                            $extension = Input::file($name)->getClientOriginalExtension();
                            $file_name = $file_name.'.'.$extension;
                            Input::file($name)->move($dir, $file_name);
                        }
                        else
                        {   
                            Image::make($image->getRealPath())->resize($width, $height)->save($dir.'/'.$file_name);
                        }
                    }
                    
                }
                else
                {
                    foreach($input['fields'][$name][1]->config as $config)
                    {
                        $dir = $config->dir;
                        $file_name = $file['name'];
                        $file_name = _upload_file_name($file_name);
                        
                        $extension = Input::file($name)->getClientOriginalExtension();
                        $file_name = $file_name.'.'.$extension;
                        Input::file($name)->move($dir, $file_name);
                    }
                    
                }
                
                $value[$name] = $file_name;
                foreach($input['fields'][$name][1]->config as $config)
                {
                    $dir = $config->dir;
                    if(!empty($data->$name))
                    {
                        @unlink($dir.'/'.$data->$name);
                    }
                }
            }            
        }
        
    }
    
    private function FilterData($input,$k,$v)
    {
        $txt = "";
        switch(strtolower($input['fields'][$k][0]))
        {
            case 'txt':
                        //$txt = mysql_real_escape_string($v);
                        $txt = $v;
                        break;
            case 'img':
                        if($input['fields'][$k][1]->resize == true)
                        {
                            if(!empty($v))
                            {
                                $file_name = $this->saveDataImageToServer($v, $input['fields'][$k][1]->config[0]->dir);
                                $txt = $file_name;
                            }
                        }
                        else
                        {
                            $txt = $v;
                        }
                        break;
            case 'select':
                        $txt = $v;
                        break;
            case 'date':
                        $v = str_replace("/", "-", $v);
                        $txt = date('Y-m-d H:i:s',strtotime($v));
                        break;
            case 'radio':
                        $txt = $v;
                        break;
            case 'textarea':
                        //$txt = mysql_real_escape_string($v);
                        $txt = $v;
                        break;
            case 'password':
                        if(!empty($v))
                            $txt = md5($v);
            default:
                    $txt = $v;
                              
        }
        if(strtolower($k) == 'password' && !empty($v))
        {
            $txt = md5($v);
        }
        if($k == 'created')
        {
            $txt = getNow();
        }
        if(!empty($txt) && is_array($txt))
        {
            $txt = implode(',',$txt);
        }
        return $txt;
    }

    private function saveDataImageToServer($data, $dir)
    {
        $img = $data;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file_name = uniqid() . '.png';
        $file = $dir .'/'. $file_name;
        $success = file_put_contents($file, $data);

        return $file_name;
    }
    
    private function outHtml($input = '')
    {
        $fields = $input['fields'];
        $html = '';
        if(count($fields) > 0)
        {
            foreach($fields as $k=>$v)
            {
                $fun = 'input_'.$v[0];
                $html .= $fun($k,$v);
            }
        }

        $html = $html;
        $title = $input['title'];
        return view('backend::admin_edit', compact('html'), compact('title'));
    }
    
    private function getTableNoPrefix($table_name = "")
    {
        return str_replace("np_", "", $table_name);
    }
}
