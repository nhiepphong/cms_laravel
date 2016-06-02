<!DOCTYPE html>
<html class=" ">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Ultra Admin : Login Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link rel="shortcut icon" href="{{ $assetURL }}images/favicon.png" type="image/x-icon" />    <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" href="{{ $assetURL }}images/apple-touch-icon-57-precomposed.png">  <!-- For iPhone -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ $assetURL }}images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ $assetURL }}images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ $assetURL }}images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->

        <!-- CORE CSS FRAMEWORK - START -->
        <link href="{{ $assetURL }}plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="{{ $assetURL }}plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ $assetURL }}plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ $assetURL }}fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="{{ $assetURL }}css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{ $assetURL }}plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <link href="{{ $assetURL }}plugins/icheck/skins/square/orange.css" rel="stylesheet" type="text/css" media="screen"/>        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE CSS TEMPLATE - START -->
        <link href="{{ $assetURL }}css/style.css" rel="stylesheet" type="text/css"/>
        <link href="{{ $assetURL }}css/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->
        <script>
        var base_url = "{{ $assetURL }}";
        </script>
        <script src="{{ $assetURL }}scripts/jquery-1.11.2.min.js" type="text/javascript"></script>
    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" login_page">

        @yield('content')
        
        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

        <!-- CORE JS FRAMEWORK - START -->  
        <script src="{{ $assetURL }}scripts/jquery.easing.min.js" type="text/javascript"></script> 
        <script src="{{ $assetURL }}plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
        <script src="{{ $assetURL }}plugins/pace/pace.min.js" type="text/javascript"></script>  
        <script src="{{ $assetURL }}plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
        <script src="{{ $assetURL }}plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
        <!-- CORE JS FRAMEWORK - END --> 

        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <script src="{{ $assetURL }}plugins/icheck/icheck.min.js" type="text/javascript"></script><!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE TEMPLATE JS - START --> 
        <script src="{{ $assetURL }}scripts/scripts.js" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS - END --> 

        <!-- Sidebar Graph - START --> 
        <script src="{{ $assetURL }}plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="{{ $assetURL }}scripts/chart-sparkline.js" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 

    </body>
</html>
