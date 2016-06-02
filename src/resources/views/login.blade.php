@extends('backend::layout.login')
@section('content')

<div class="login-wrapper">
    <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
        <h1><a href="#" title="Login Page" tabindex="-1">Admin</a></h1>

        <form name="loginform" id="loginform" action="" method="post">
        	{!! csrf_field() !!}
            <p>
                <label for="user_login">Username<br />
                    <input type="text" name="username" id="user_login" class="input" value="" size="20" /></label>
            </p>
            <p>
                <label for="user_pass">Password<br />
                    <input type="password" name="password" id="user_pass" class="input" value="" size="20" /></label>
            </p>

            <p class="submit">
                <input type="submit" name="submit" id="wp-submit" class="btn btn-orange btn-block" value="Sign In" />
            </p>
        </form>

    </div>
</div>

<!-- General section box modal start -->
<div class="modal" id="section-login" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog animated bounceInDown">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn_close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login Alert</h4>
            </div>
            <div class="modal-body">
                {!!$message!!}
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn_close" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
<?php 
if(!empty($message))
{
?>
<script type="text/javascript">

$(document).ready(function(){
    $("#section-login").show();
    $(".btn_close").click(function(){
        $("#section-login").hide();
    });
});

</script>
<?php 
}
?>

@endsection