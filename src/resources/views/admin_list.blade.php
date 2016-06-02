@extends('backend::layout.backend')

<?php $id = intval($id_content);?>

@section('content')

@include('backend::includes.tool_list')

<form action="" method="post" name="form_data" id="form_data">
{!! csrf_field() !!}
<div class="col-lg-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left"><?=(isset($title) ? $title : 'List Contents')?></h2>
            <div class="actions panel_actions pull-right">
                <i class="box_toggle fa fa-chevron-down"></i>
            </div>
        </header>
        <div class="content-body">  
            <input type="hidden" name="array_id" id="array_id" value=""/>  
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="dataTables_length">
                                <label>Choose action tool: 
                                    <select class="form-control m-bot15 select_with150" name="dropdown" id="choose_action">
                                        <option value="0">Choose an action...</option>
                                        <?php 
                                            echo '<option value="2">Delete</option>';
                                            echo '<option value="3">Active</option>';
                                            echo '<option value="4">Unactive</option>';
                                        ?>
                                        </select>
                                </label>
                                <input class="btn btn-primary" type="submit" name="config" value="Apply" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div id="example-1_filter" class="div_align_right">
                                <?php 
                                if($not_show_btn_add != 1)
                                {
                                ?>
                                <a href="<?=url('admin/'.CONTROLLER.'/add/'.$id);?>" data-toggle="modal" class="btn btn-primary btn-add">Add New</a>
                                <?php
                                }
                                ?>
                                <a href="#section-search" data-toggle="modal" class="btn btn-primary">Advanced Search</a>
                            </div>
                        </div>
                    </div>
                    <div class="overflow_scroll">
                        <table id="table_list" class="table table-small-font table-bordered table-striped dt-responsive display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="20"><input class="checkall" type="checkbox" value="all" /></th>
                                    <?php 
                                        foreach($fields as $k=>$v)
                                        {
                                            echoColumnTitle($k,$v,$sort,$by,$link,$start);        
                                        }
                                    ?>
                                    <th>Task</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th width="20"><input class="checkall" type="checkbox" value="all" /></th>
                                    <?php 
                                        foreach($fields as $k=>$v)
                                        {
                                            echoColumnTitle($k,$v,$sort,$by,$link,$start);        
                                        }
                                    ?>
                                    <th>Task</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php 
                                if(isset($data) && !empty($data))
                                {
                                    $i = 0;
                                    foreach($data as $dt)
                                    {
                                        echo '<tr role="row" class="'.($i%2 == 0 ? "even" : "odd").'">';

                                        if(CONTROLLER == "permissions" && Session::get('admin_user_id') == $dt->id)
                                        {
                                            echo '<td class="checkboxes"></td>';
                                        }
                                        else
                                        {
                                            echo '<td class="checkboxes"><input name="check_'.$i.'" id="check_'.$i.'" value="'.$dt->id.'" type="checkbox" /></td>';
                                        }
                                        foreach($fields as $k=>$v)
                                        {
                                            echoColumn($k,$v,$dt);
                                            
                                        }
                                        echo '<td width="70">';
                                        echo '<a href="'.url('admin/'.CONTROLLER.'/edit/'.$dt->id).'" title="Edit" class="edit_record"><span class="glyphicon glyphicon-edit"></span></a>';
                                        if(CONTROLLER == "permissions" && Session::get('admin_user_id') == $dt->id)
                                        {

                                        }
                                        else
                                        {
                                            echo '<a href="javascript:void(0);" title="Delete" class="delete_record" ref="'.$dt->id.'"><span data-class="trash"><i class="fa fa-trash"></i></span></a>';
                                        }
                                        
                                        echo '</td>';
                                        echo '</tr>';
                                        $i++;      
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="dataTables_info" id="example-1_info" role="status" aria-live="polite"><?=$title_page;?></div>
                        </div>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap" id="example-1_paginate">
                                <?php 
                                if(isset($linkPage) && !empty($linkPage))
                                echo $linkPage;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</form>

@endsection

<?php 
function echoColumnTitle($k,$v,$sort,$by,$link,$start)
{
    if($sort == $k)
    {
        if(strtolower($by) == 'asc')
        {
            echo '<th class="sorting_desc" onClick="onChangeLinkSort(\''.$link.$k.'/DESC/'.$start.'\');">'.$v[1].'</a></th>';
        }
        else
        {
            echo '<th class="sorting_asc"onClick="onChangeLinkSort(\''.$link.$k.'/ASC/'.$start.'\');">'.$v[1].'</a></th>';   
        }
    }
    else
    {
        echo '<th class="sorting"onClick="onChangeLinkSort(\''.$link.$k.'/ASC/'.$start.'\');">'.$v[1].'</a></th>';   
    }
}

function echoColumn($k,$v,$data)
{
    switch($v[0]) 
    {
        case 'avatar': 
            echo '<td align="center">';
            if( empty($data->$k) ) 
                echo '[none]';
            else
            {           
                echo '<ul class="thumbs" align="center">';
                echo '<li>';
                echo '<a href="'.$v[4].(isset($data->$v[5]) ? $data->$v[5] : "").'"><img src="'.get_link_thumb($data->$k, $v[3]).'" width="'.$v[2].'"></a>';
                echo '</li>';
                echo '</ul>';
            }
            echo '</td>'; 
            break;
        case 'img': 
            echo '<td align="center">';
            if( empty($data->$k) ) 
                echo '[none]';
            else
            {
                echo '<a rel="prettyPhoto" href="'.get_link_thumb($data->$k, $v[3]).'"><img src="'.get_link_thumb($data->$k, $v[3]).'" width="'.$v[2].'"></a>';
            }
            echo '</td>'; 
            break;
        case 'img_multi': 
            echo '<td align="center">';
            if( empty($data->$k) ) 
                echo '[none]';
            else
            {
                $hinh = GetArrayImage($data->$k);
                echo '<a rel="prettyPhoto" href="'.get_link_thumb($hinh[0], $v[3]).'"><img src="'.get_link_thumb($hinh[0], $v[3]).'" width="'.$v[2].'"></a>';
            }
            echo '</td>'; 
            break;
        case 'txt': 
            echo '<td>'.reverse_escape($data->$k).'</td>'; 
            break;
        case 'txt_custom_status': 
            switch($data->$k)
            {
                case 1:
                    echo '<td><span class="connect_java" id="stauts_'.$data->id.'_'.$data->$k.'">Đã đặt hàng</span></td>'; 
                    break;
                case 2:
                    echo '<td><span class="connect_java" id="stauts_'.$data->id.'_'.$data->$k.'">Đã mua thành công</span></td>'; 
                    break;
                default:
                    echo '<td><span class="connect_java" id="stauts_'.$data->id.'_'.$data->$k.'">Chưa Mua</span></td>'; 
            }
            break;
        case 'select': 
            echo '<td>'.$data->$k.'</td>'; 
            break;
        case 'date': 
            echo '<td>'.date($v[2],strtotime($data->$k)).'</td>'; 
            break;
        case 'status':
            echo '<td align="center">';
            if($k == "tinh_trang")
            {
                if($data->$k == 1) 
                    echo 'Còn Hàng';
                else 
                    echo 'Hết Hàng';
            }
            else
            {
                if($data->$k == 1) 
                    echo '<img src="'.ROOT_ASSET.'images/published.png">';
                else 
                    echo '<img src="'.ROOT_ASSET.'images/unpublished.png">';
            }
            echo '</td>'; 
            break;
        case 'status_custom_date':
            echo '<td align="center">';
            if(strtotime($data->$k) - mktime() > 0) 
                echo '<img src="'.ROOT_ASSET.'images/published.png">';
            else 
                echo '<img src="'.ROOT_ASSET.'images/unpublished.png">';
            echo '</td>'; 
            break;
        case 'link':   
            echo '<td><a href="'.$v[3].(isset($data->$v[4]) ? $data->$v[4] : "").'" title="View detail '.$v[1].'" target="'.(isset($v[5]) ? $v[5] : "_self").'">'.$data->$k.'</a></td>';
            break;
        case 'link_blank':   
            echo '<td><a href="'.$v[2].$data->$v[3].'" target="_blank">'.$v[1].'</a></td>';
            break;
        case 'push_notification':   
            echo '<td><a href="'.url('admin/send_notification/index/'.$data->$v[2]).'" target="_blank">PUSH</a></td>';
            break;
        case 'button_new_window':   
            echo '<td><a href="javascript:void();" onClick="openNewWindow(\''.$v[2].$data->$v[3].'\');return false;" target="_blank">'.$v[1].'</a></td>';
            break;
        default: 
            echo '<td>'.$col[2].'</td>'; 
            break;
    }
}

function get_link_thumb($t, $dir)
{
    $thumb = "";
    if (!empty($t)) 
    {
        if(strrpos($t, "http") === false) 
            $thumb = $dir.$t; 
        else 
            $thumb = $t;
    }
    else 
    {
        $thumb = ROOT_ASSET."images/noimage.jpg";
    }
    
    return $thumb;
}
?>