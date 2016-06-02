@extends('backend::layout.backend')

@section('content')

@include('backend::includes.tool_edit')

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
    <section class="box ">
        <header class="panel_header">
            <h2 class="title pull-left"><?=(isset($title) ? $title : 'List Contents')?></h2>
            <div class="actions panel_actions pull-right">
                <i class="box_toggle fa fa-chevron-down"></i>
            </div>
        </header>
        <div class="content-body">
            <div class="row">
                <form action="" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <?php 
                    if(isset($html) && !empty($html))
                        echo $html;
                    ?>
                    <div class="form-group has-warning">
                        <label class="form-label" for="field-9"></label>
                        <div class="controls">
                            <input class="btn btn-primary" type="submit" name="submit" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
