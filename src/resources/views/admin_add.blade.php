@extends('backend::layout.backend')

@section('title', $title)

@section('content')

@include('backend::includes.tool_add')

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="wTitle">
            <h5><?=(isset($title) ? $title : 'List Contents')?></h5>
            </div>
            <div class="wContent">
            <form class="form_submit" action="" method="post" enctype="multipart/form-data"
                data-bv-message="This value is not valid"
                data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                {!! csrf_field() !!}
                <?php 
                if(isset($html) && !empty($html))
                    echo $html;
                ?>
                <div class="form-group has-warning">
                    <label class="form-label" for="field-9"></label>
                    <div class="controls">
                        <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection