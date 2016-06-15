@extends('backend::layout.backend')

@section('title', 'Dashboard')

@section('content')

<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <div class="page-title">
        <div class="pull-left">
            <h1 class="title">Dashboard</h1>                            
        </div>
    </div>
</div>
<div class="clearfix"></div>


<div class="col-lg-12">
    <section class="box nobox">
        <div class="content-body">
            
            <?php 
            if($data && count($data) > 0)
            {
                $i = 0;
                foreach ($data as $dt)
                {
                    $icon   = $dt->icon;
                    $link   = $dt->link;
                    $value  = $dt->value;
                    $name   = $dt->name;

                    if($i%4 == 0)
                    {
                        echo '<div class="row">';
                    }

                    echo '<div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="r4_counter db_box db_box_pointer" onclick="location.href=\''.$link.'\';">
                    <i class=\'pull-left fa icon-md icon-rounded '.$icon.'\'></i>
                    <div class="stats">
                    <h4><strong>'.$value.'</strong></h4>
                    <span>'.$name.'</span>
                    </div>
                    </div>
                    </div>';

                    $i++;
                    if($i%4 == 0)
                    {
                        echo '</div>';
                    }
                }

                if($i%4 > 0)
                {
                    echo '</div>';
                }
            }
            ?>

        </div>
    </section>
</div>

@endsection