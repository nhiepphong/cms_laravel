@extends('backend::layout.backend')

@section('content')

@include('backend::includes.tool_add')

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="wTitle">
            <h5><?=(isset($title) ? $title : 'List Contents')?></h5>
            </div>
            <div class="wContent">
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
    </div>
</div>
@endsection