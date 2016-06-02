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
            
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="r4_counter db_box">
                        <i class='pull-left fa fa-users icon-md icon-rounded icon-primary'></i>
                        <div class="stats">
                            <h4><strong><?=(isset($count_user) ? $count_user : 0);?></strong></h4>
                            <span>User Register</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="r4_counter db_box">
                        <i class='pull-left fa fa-clipboard icon-md icon-rounded icon-purple'></i>
                        <div class="stats">
                            <h4><strong><?=(isset($count_edu_profile) ? $count_edu_profile : 0);?></strong></h4>
                            <span>Count Edu Profile</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="r4_counter db_box">
                        <i class='pull-left fa fa-file-code-o icon-md icon-rounded icon-warning'></i>
                        <div class="stats">
                            <h4><strong><?=(isset($count_edu_subject) ? $count_edu_subject : 0);?></strong></h4>
                            <span>Count Edu Subject</span>
                        </div>
                    </div>
                </div>
            </div> <!-- End .row -->	

        </div>
    </section>
</div>

@endsection