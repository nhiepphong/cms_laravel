<?php

//Đã Update
if ( ! function_exists('input_label'))
{
    function input_label($name = '',$data = null)
    {
        $html = '<div class="form-group has-static">';

        $type = $data[0];
        $data = $data[1];
        
        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        $html .= '<div class="controls">';

        if(property_exists($data,'value'))
        {
            $value = reverse_escape($data->value);
        }
        else
        {
            $value = '';
        }
        $html .= '<p class="form-control-static">';
        if(isset($value))
        {
            $html .= $value;
        }
        else
        {
            $html .= "";
        }
        $html .= "</p>";
        
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}

//Đã Update
if ( ! function_exists('input_txt'))
{
    function input_txt($name = '',$data = null)
    {
        $html = '<div class="form-group has-static">';
        
        $type = $data[0];
        $data = $data[1];
        
        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        $html .= '<div class="controls">';

        if(property_exists($data,'value'))
        {
            $value = reverse_escape($data->value);
        }
        else
        {
            $value = '';
        }

        $validation = "";

        if(property_exists($data,'required'))
        {
            if($data->required)
            {
                $validation = 'required data-bv-notempty-message="The '.$data->label.' is required and cannot be empty"';
            }
        }

        if(isset($value))
        {
            $html .= '<input '.$validation.' type="text" class="form-control" placeholder="'.$data->label.'" id="'.$name.'" name="'.$name.'" value="'.$value.'" />';
        }
        else
        {
            $html .= '<input '.$validation.' type="text" class="form-control" placeholder="'.$data->label.'" id="'.$name.'" name="'.$name.'" />';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}

//Đã Update
if ( ! function_exists('input_password'))
{
    function input_password($name = '',$data = null)
    {
        $html = '<div class="form-group has-static">';
        
        $type = $data[0];
        $data = $data[1];
        
        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        $html .= '<div class="controls">';

        $html .= '<input type="password" class="form-control" placeholder="'.$data->label.'" id="'.$name.'" name="'.$name.'" />';
        
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}

//Đã Update
if ( ! function_exists('input_hide'))
{
    function input_hide($name = '',$data = null)
    {
        $type = $data[0];
        $data = $data[1];
        
        $html = '';
        if(property_exists($data,'value'))
        {
            $value = $data->value;
        }
        else
        {
            $value = '';
        }
        
        $html .= '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value.'" />';
        
        return $html;
    }
}

//Đã Update
if ( ! function_exists('input_checkbox'))
{
    function input_checkbox($name = '',$data = null)
    {
        $html = '<div class="form-group has-static">';
        
        $type = $data[0];
        $data = $data[1];
        
        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        $html .= '<div class="controls">';
        $html .= '<ul class="list-unstyled">';

        $permission_data = explode(',',$data->value);
        
        if(property_exists($data,'valueSource'))
        {
            $data_source = $data->valueSource;
            $i = 0;
            foreach($data_source as $dt)
            {
                $html .= '<li>';
                $html .= '<input tabindex="5" type="checkbox" class="skin-square-blue" name="permissions[]" '.(in_array($dt->v,$permission_data) ? 'checked' : '').' value="'.$dt->v.'" id="permissions_'.$i.'">';
                $html .= '<label class="icheck-label form-label" for="permissions_'.$i.'">'.$dt->k.'</label>';
                $html .= '</li>';
                $html .= '<label>';
                $i++;
            }
        }
        
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}

//Đã Update
if ( ! function_exists('input_radio'))
{
    function input_radio($name = '',$data = null)
    {

        $html = '<div class="form-group has-static">';
        
        $type = $data[0];
        $data = $data[1];
        
        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        $html .= '<div class="controls">';
        $html .= '<ul class="list-unstyled list_row">';

        if(property_exists($data,'value'))
        {
            $value = $data->value;
        }
        else
        {
            $value = 0;
        }

        $validation = "";

        if(property_exists($data,'required'))
        {
            if($data->required)
            {
                $validation = 'required data-bv-notempty-message="The '.$data->label.' is required and cannot be empty"';
            }
        }

        if(property_exists($data,'valueSource'))
        {
            $i = 0;
            foreach($data->valueSource as $k=>$v)
            {
                $html .= '<li>';
                $html .= '<input '.$validation.' tabindex="5" type="radio" class="icheck-minimal-blue" '.($value == $k ? 'checked' : '').' name="'.$name.'" id="'.$name.'_'.$i.'" value="'.$k.'">';
                $html .= '<label class="icheck-label form-label" for="'.$name.'_'.$i.'">'.$v.'</label>';
                $html .= '</li>';
                $i++;
            }
        }
        
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;

    }
}

//Đã Update
if ( ! function_exists('input_img'))
{
    function input_img($name = '',$data = null)
    {
        $type = "normal";

        $html = '<div class="form-group has-static">';
        
        $type = $data[0];
        $data = $data[1];

        $config = $data->config;
        
        if(property_exists($data,'resize'))
        {
            if($data->resize)
            {
                $type = "resize";
            }
        }

        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        $html .= '<div class="controls">';

        if(property_exists($data,'value'))
        {
            $value = reverse_escape($data->value);
        }
        else
        {
            $value = '';
        }

        $v = explode("http", $value);
        if(count($v) == 3)
            $value = "http".$v[2];
        
        if(isset($value) && !empty($value))
        {
            $html .= '<div class="preview_img preview_img-lg">';
            $html .= '<img id="preview_'.$name.'" src="'.$value.'"/>';
            $html .= "</div>";
        }
        else
        {
            if($type == "resize")
            {
                $html .= '<div class="preview_img preview_img-lg">';
                $html .= '<img id="preview_'.$name.'" src=""/>';
                $html .= "</div>";
            }            
        }

        if($type == "resize")
        {
            $html .= '<input type="hidden" name="'.$name.'" id="'.$name.'" value="" />';
            $html .= '<div class="eg-button controls">';
            $html .= '<button type="button" id="inputImage_'.$name.'" class="btn btn-info" data-toggle="modal" onclick="loadPageCropImage('.$config[0]->width.', '.$config[0]->height.', \''.$name.'\');">Upload</button>';
            $html .= '</div>';

            $html .= '<div class="modal fade" id="ultraModal_'.$name.'"  tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
            <div class="modal-dialog" style="width: 930px">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Image Cropper</h4>
            </div>
            <div class="modal-body">
          
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>';
        }
        else
        {
            $html .= '<input type="file" class="form-control" name="'.$name.'" id="'.$name.'" >';
        }
        
        $html .= '<div class="clearfix"></div>';

        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}

//Đã Update
if ( ! function_exists('input_textarea'))
{
    function input_textarea($name = '',$data = null)
    {
        $html = '<div class="form-group has-static">';
        
        $type = $data[0];
        $data = $data[1];
        
        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        $html .= '<div class="controls">';

        if(property_exists($data,'value'))
        {
            $value = reverse_escape($data->value);
        }
        else
        {
            $value = '';
        }

        $row = 5;
        if(property_exists($data,'type') && $data->type == 'html')
        {
            $html .= '<script type="text/javascript">';
            $html .= "KE.show({
            id : '".$name."',
            skinType: 'office',
            cssPath : '".ROOT_PUBLIC."editor/index.css',
            urlType : 'domain',
            items : [
            'source', 'fullscreen', 'print', 'undo', 'redo', 'cut', 'copy', 'paste',
            'plainpaste', 'wordpaste', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
            'superscript', 'emoticons', 'link', 'unlink', '-',
            'title', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold',
            'italic', 'underline', 'strikethrough', 'removeformat', 'selectall', 'image',
            'flash', 'media', 'table', 'hr', 'about'
            ]
            });
            </script>";
            $row = 15;
        }
        else if(property_exists($data,'type') && $data->type == 'flash')
        {
        
        }
        else
        {
        
        }
        $html .= '<textarea class="form-control wysiwyg" id="'.$name.'" name="'.$name.'" cols="79" rows="'.$row.'">'.$value.'</textarea>';

        $html .= '</div>';
        $html .= '</div>';
        return $html;

    }
}

if ( ! function_exists('input_date'))
{
    function input_date($name = '',$data = null)
    {

        $html = '<div class="form-group has-static">';
        
        $type = $data[0];
        $data = $data[1];
        
        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        if(property_exists($data,'type') && $data->type == 'date_time')
        {
            $data_format = "yyyy-mm-dd HH:ii:ss";
            $data_format_php = "Y-m-d H:i:s";
            
        }
        else
        {
            $data_format = "yyyy-mm-dd";
            $data_format_php = "Y-m-d";
            
        }

        $html .= '<div class="controls">';

        if(property_exists($data,'value'))
        {
            $value = date($data_format_php, strtotime($data->value));
        }
        else
        {
            $value = date($data_format_php);
        }

        if(property_exists($data,'type') && $data->type == 'date_time')
        {
            $html .= '<div class="input-group date form_datetime_'.$data->id_div.' col-md-5" data-date="'.$value.'" data-date-format="'.$data_format.'" data-link-field="'.$name.'" data-link-format="yyyy-mm-dd HH:ii:ss">
                    <input class="form-control" size="16" type="text" value="'.$value.'" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="'.$name.'" name="'.$name.'" value="'.$value.'" />';
            $html .= '<script type="text/javascript">
                    $(function()
                    {
                        $(".form_datetime_'.$data->id_div.'").datetimepicker({
                            //language:  "fr",
                            weekStart: 1,
                            todayBtn:  1,
                            autoclose: 1,
                            todayHighlight: 1,
                            startView: 2,
                            forceParse: 0,
                            showMeridian: 1
                        });
                });
                </script>';
            
        }
        else
        {
            $html .= '<div class="input-group date form_date_'.$data->id_div.' col-md-5" data-date="'.$value.'" data-date-format="'.$data_format.'" data-link-field="'.$name.'" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" id="'.$name.'" value="'.$value.'" />';
            $html .= '<script type="text/javascript">
                    $(function()
                    {
                        $(".form_date_'.$data->id_div.'").datetimepicker({
                            language:  "fr",
                            weekStart: 1,
                            todayBtn:  1,
                            autoclose: 1,
                            todayHighlight: 1,
                            startView: 2,
                            minView: 2,
                            forceParse: 0
                        });
                });
                </script>';
            
        }
        
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}

//Đã Update
if ( ! function_exists('input_select'))
{
    function input_select($name = '',$data = null)
    {
        $html = '<div class="form-group has-static">';
        
        $type = $data[0];
        $data = $data[1];
        
        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        $html .= '<div class="controls">';

        if(property_exists($data,'value'))
        {
            $value = $data->value;
        }
        else
        {
            $value = '';
        }

        $validation = "";

        if(property_exists($data,'required'))
        {
            if($data->required)
            {
                $validation = 'required data-bv-notempty-message="The '.$data->label.' is required and cannot be empty"';
            }
        }

        $html .= '<select '.$validation.' name="'.$name.'" class="form-control m-bot15">';
        $html .= '<option value="">NONE</option>';
        if(property_exists($data,'valueSource'))
        {
            foreach($data->valueSource as $dt)
            {
                if($dt->k == $value)
                {
                    $html .= '<option value="'.$dt->k.'" selected="selected">'.$dt->v.'</option>';
                }   
                else
                {
                    $html .= '<option value="'.$dt->k.'">'.$dt->v.'</option>';
                }    
            }
        }
        $html .= '</select>';
        
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}

//Đã Update
if ( ! function_exists('input_select_multiple'))
{
    function input_select_multiple($name = '',$data = null)
    {
        $html = '<div class="form-group has-static">';
        
        $type = $data[0];
        $data = $data[1];
        
        $html .= '<label class="form-label">'.$data->label.'</label>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<span class="desc">e.g. '.$data->description.'</span>';
        }

        $html .= '<div class="controls">';

        if(property_exists($data,'value'))
        {
            $value = $data->value;
        }
        else
        {
            $value = '';
        }

        $html .= '<select name="'.$name.'[]" id="'.$name.'" multiple="multiple">';
        
        if(property_exists($data,'valueSource'))
        {
            foreach($data->valueSource as $dt)
            {
                if(in_array($dt->k, $value))
                {
                    $html .= '<option value="'.$dt->k.'" selected="selected">'.$dt->v.'</option>';
                }   
                else
                {
                    $html .= '<option value="'.$dt->k.'">'.$dt->v.'</option>';
                }    
            }
        }
        $html .= '</select>';

        $html .= '<script type="text/javascript">
                    $(document).ready(function() {
                        $("#'.$name.'").multiselect();
                    });
                </script>';
        
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}

if ( ! function_exists('input_autocomplete'))
{
    function input_autocomplete($name = '',$data = null)
    {
        $html_s = '<div class="formWizard">';
        $html_s .= '<div class="row-fluid">';

        $html_e = '</div>';
        $html_e .= '</div>';
        
        $type = $data[0];
        $data = $data[1];
        
        $html = $html_s;
        $html .= '<div class="span3">';
        $html .= '<span class="fLabel">'.$data->label.'</span>';
        $html .= '</div>';
        $html .= '<div class="span9">';
        if(property_exists($data,'value'))
        {
            $value_tmp = $data->value;
            if($value_tmp['id'])
            {
                $value_id = $value_tmp['id'];
            }
            else
            {
                $value_id = '';
            }
            if($value_tmp['name'])
            {
                $value_label = $value_tmp['name'];
            }
            else
            {
                $value_label = '';
            }
        }
        else
        {
            $value = '';
        }
        
        if(property_exists($data,'link_get'))
        {
            $link_get = $data->link_get;
        }
        else
        {
            $link_get = '';
        }
        
        $html .= '<script type="text/javascript">';
        $html .= '$(function() {';
        $html .= 'setAutoComplete("'.$name.'_autocomplete", "'.$name.'", "results", "'.$link_get.'/");';
        $html .= '});';
        $html .= '</script>';
        if(isset($value_id))
        {
            $html .= '<input class="text-input small-input" type="text" id="'.$name.'_autocomplete" name="'.$name.'_autocomplete" value="'.$value_label.'" />';
            $html .= '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value_id.'" />';
        }
        else
        {
            $html .= '<input class="text-input small-input" type="text" id="'.$name.'_autocomplete" name="'.$name.'_autocomplete" />';
            $html .= '<input type="hidden" name="'.$name.'" id="'.$name.'" value="" />';
        }
        
        if(property_exists($data,'description'))
        {
            $html .= '<br />';
            $html .= '<small>'.$data->description.'</small>';   
        }
        $html .= '</div>';
        $html .= $html_e;
        return $html;
    }
}
if ( ! function_exists('input_tag'))
{
    function input_tag($name = '',$data = null)
    {
        $html_s = '<div class="formWizard">';
        $html_s .= '<div class="row-fluid">';

        $html_e = '</div>';
        $html_e .= '</div>';
        
        $type = $data[0];
        $data = $data[1];
        
        $html = $html_s;
        $html .= '<div class="span3">';
        $html .= '<span class="fLabel">'.$data->label.'</span>';
        $html .= '</div>';
        $html .= '<div class="span9">';
        if(property_exists($data,'value'))
        {
            $value = $data->value;
        }
        else
        {
            $value = '';
        }
        
        if(property_exists($data,'link_get'))
        {
            $link_get = $data->link_get;
        }
        else
        {
            $link_get = '';
        }
        
        $html .= '<script type="text/javascript">';
        $html .= '$(function() {';
            $html .= "$('#".$name."').tagsInput({";
            $html .= "width: 'auto',";
            $html .= "defaultText:'Add Tag',";
            $html .= "autocomplete_url:'".$link_get."'";
            $html .= "});";
        $html .= '});';
        $html .= '</script>';
        
        $html .= '<input id="'.$name.'" name="'.$name.'" type="text" class="tags" value="'.$value.'"></p>';
        
        if(property_exists($data,'description'))
        {
            $html .= '<br />';
            $html .= '<small>'.$data->description.'</small>';   
        }
        $html .= '</div>';
        $html .= $html_e;
        return $html;
    }
}
if ( ! function_exists('input_mp3'))
{
    function input_mp3($name = '',$link = '')
    {
        $html = '<script type="text/javascript">
            $(document).ready(function(){

                $("#jquery_jplayer_1").jPlayer({
                    ready: function () {
                        $(this).jPlayer("setMedia", {
                            mp3:"'.$link.'"
                        });
                    },
                    swfPath: "'.ROOT_PUBLIC.'scripts/admin/jplayer",
                    supplied: "mp3",
                    wmode: "window"
                });
            });
            </script>
            <div class="wContent" align="center">
              <!-- Player start -->
              <div id="jquery_jplayer_1" class="jp-jplayer"></div>
              <div id="jp_container_1" class="jp-audio">
                <div class="jp-type-single">
                  <div class="jp-gui jp-interface">
                    <ul class="jp-controls">
                      <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                      <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                      <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                      <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                      <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                      <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
                    </ul>
                    <ul class="jp-toggles">
                      <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
                      <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
                    </ul>
                    <div class="jp-progress">
                      <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>

                      </div>
                    </div>
                    <div class="jp-volume-bar">
                      <div class="jp-volume-bar-value"></div>
                    </div>
                    <div class="jp-current-time"></div>
                    <div class="jp-duration"></div>
                  </div>
                  <div class="jp-title">
                    <ul>
                      <li>'.$name.'</li>
                    </ul>
                  </div>
                  <div class="jp-no-solution">
                    <span>Update Required</span>
                    To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                  </div>
                </div>
              </div>
              <!-- Player end -->
            </div>';
        return $html;
    }
}
if ( ! function_exists('input_video'))
{
    function input_video($name = '',$data = null)
    {
        $html_s = '<div class="formWizard">';
        $html_s .= '<div class="row-fluid">';

        $html_e = '</div>';
        $html_e .= '</div>';
        
        $type = $data[0];
        $data = $data[1];
        
        $html = $html_s;
        $html .= '<div class="span3">';
        $html .= '<span class="fLabel">'.$data->label.'</span>';
        $html .= '</div>';
        $html .= '<div class="span9">';
        if(property_exists($data,'value'))
        {
            $value = $data->value;
        }
        else
        {
            $value = '';
        }
        
        if(isset($value) && !empty($value))
        {
            $html .= '
            <script type="text/javascript" src="'.ROOT_PUBLIC.'scripts/flowplayer-3.2.6.min.js"></script>
            <div id="post_video">
                        <a href="'.$value.'" style="display:block;width:427px;height:345px" id="player"></a>
                        <script>
                            flowplayer("player", "'.ROOT_PUBLIC.'flash/flowplayer-3.2.7.swf", {
                            canvas: {backgroundColor: "#000000"},
                            plugins: {
                               controls: {
                                  url: "'.ROOT_PUBLIC.'flash/flowplayer.controls-tube-3.2.5.swf",
                                  sliderGradient: "none",
                                  volumeSliderGradient: "none",
                                  buttonOffColor: "#686868",
                                  durationColor: "#999999",
                                  timeColor: "#999999",
                                  sliderColor: "#C9C9C9",
                                  progressGradient: "medium",
                                  borderRadius: "1px solid #dedede",
                                  backgroundGradient: "medium",
                                  volumeSliderColor: "#cccccc",
                                  volumeColor: "#ff9d9d",
                                  timeBorder: "1px solid #dedede",
                                  timeBgColor: "#fafafa",
                                  backgroundColor: "#cccccc",
                                  bufferGradient: "medium",
                                  autoHide: "never",
                                  tooltipColor: "#C9C9C9",
                                  bufferColor: "#ffcece",
                                  progressColor: "#ff9d9d",
                                  buttonOverColor: "#a60101",
                                  tooltipTextColor: "#3c3c3c",
                                  buttonColor: "#7f7f7f",
                                  height: 24,
                                  opacity: 1.0
                               }
                            }
                            });
                        </script>
                    </div> <br/>';
            $html .= '<input type="file" class="text-input small-input" name="'.$name.'" id="'.$name.'" />';
        }
        else
        {
            $html .= '<input type="file" class="text-input small-input" name="'.$name.'" id="'.$name.'" />';
        }
        if(property_exists($data,'description'))
        {
            $html .= '<div style="clear:both"></div>';
            $html .= '<small>'.$data->description.'</small>';   
        }
        $html .= '</div>';
        $html .= $html_e;
        return $html;
    }
}