<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="section-search" class="modal fade" style="display: none;">
    <form action="" method="post">
        {!! csrf_field() !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Advanced Search</h4>
                </div>
                <div class="modal-body">

                    <?php 
                        foreach($fields as $k=>$v)
                        {
                            if(isset($v[2]) && $v[2] == 1)
                            {
                                echo '<div class="form-group">';
                                echo '<label for="'.$k.'" class="form-label">'.$v[1].'</label>';

                                if($v[0] == 'txt' || $v[0] == 'link' || $v[0] == 'txt_custom_status_1'  || $v[0] == 'status')
                                {
                                    echo '<input type="text" class="form-control" id="'.$k.'" name="'.$k.'" placeholder="'.$v[1].'">';
                                }
                                else if($v[0] == 'select')
                                {
                                    echo '<select id="'.$k.'" name="'.$k.'">';
                                    echo '<option value="0">None</option>';
                                    foreach($v[3] as $dt)
                                    {
                                        echo '<option value="'.$dt['k'].'">'.$dt['v'].'</option>';
                                    }
                                    echo '</select>';
                                }
                                echo '</div>';
                            }      
                        }
                    ?>
                    <div class="checkbox">
                    </div>
                    <input class="btn btn-primary" type="submit" name="search" value="Search" />
                </div>
            </div>
        </div>
    </form>
</div>

<div id="myModalField" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo url('admin/book_list/custom_field_view')?>" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Custom Field View</h5>
        </div>
        <div class="modal-body">
            <table width="400" border="0">
            <?php 
                if(Session::get('fields_custom'))
                {
                    $fields_custom = Session::get('fields_custom');
                    
                    foreach($fields_custom as $k=>$v)
                    {
                        echo '<tr>';
                        echo '<td width="100" class="title_search">'.$v[1].'</td>';
                        echo '<td align="left" class="input_search"><input name="'.$k.'" id="'.$k.'" value="1" type="checkbox" '.($v[0]== 1 ? 'checked' : '').'/></td>';
                        echo '</tr>';     
                    }
                }
                
            ?>
                <tr>
                    <td width="100" align="right">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button class="button bSky sButton" data-dismiss="modal" aria-hidden="true">Close</button>
            <input class="button bMuddy sButton" type="submit" name="search" value="Submit" />
        </div>
    </form>
</div>