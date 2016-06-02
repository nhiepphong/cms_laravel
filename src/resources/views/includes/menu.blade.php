<?php 

function echoContainerNav($data, $level = 0)
{
    if(count($data) > 0)
    {
        $i = 0;
        foreach($data as $dt)
        {
            $tClass = "";
            if(count($dt['sub']) > 0)
            {
                if($dt['parent_id'] == 0)
                {
                    if(CONTROLLER == $dt['model'])
                    {
                        $tClass = "open";   
                    }
                }
            }
            else
            {
                if($dt['parent_id'] == 0)
                {
                    if(CONTROLLER == $dt['model'])
                    {
                        $tClass = "open";   
                    }
                }
            }
            
            if($dt['link'] != '#')
            {
                $link = url('/admin/'.$dt['link']);
            }
            else
            {
                $link = 'javascript:;';
            }

            $class_icon = array("fa-dashboard", "fa-th", "fa-suitcase", "fa-sliders", "fa-gift","fa-envelope", "fa-bar-chart", "fa-table", "fa-columns", "fa-map-marker", "fa-folder-open");

            echo '<li class="'.$tClass.'">';
            echo '<a href="'.$link.'">';
            echo '<i class="fa '.$class_icon[($i > (count($class_icon)-1) ? (count($class_icon)-1) : $i) ].'"></i>';
            echo '<span class="title">'.$dt['name'].'</span>';
            if(count($dt['sub']) > 0)
            {
                echo '<span class="arrow "></span>';
            }
            echo '</a>';
            // if($level == 0)
            // {
            //     $class_icon = array("fa-dashboard", "fa-th", "fa-suitcase", "fa-sliders", "fa-gift","fa-envelope", "fa-bar-chart", "fa-table", "fa-columns", "fa-map-marker", "fa-folder-open");

            //     echo '<li class="'.$tClass.'">';
            //     echo '<a href="'.$link.'">';
            //     echo '<i class="fa '.$class_icon[($i > (count($class_icon)-1) ? (count($class_icon)-1) : $i) ].'"></i>';
            //     echo '<span class="title">'.$dt['name'].'</span>';
            //     if(count($dt['sub']) > 0)
            //     {
            //         echo '<span class="arrow "></span>';
            //     }
            //     echo '</a>';
            // }
            // else
            // {
            //     echo '<li>';
            //     echo '<a href="'.$link.'">'.$dt['name'].'</a>';
            // }

            if(count($dt['sub']) > 0)
            {
                echo '<ul class="sub-menu" >';
                echoContainerNav($dt['sub'], $level++);
                echo "</ul>";
            }
            echo "</li>"; 
            $i++;      
        }   
    }
}
echoContainerNav($data);

?>
