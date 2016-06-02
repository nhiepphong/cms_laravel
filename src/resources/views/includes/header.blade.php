<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>@yield('title') - Admin</title>
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
<link href="{{ $assetURL }}plugins/morris-chart/css/morris.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/rickshaw-chart/css/graph.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/rickshaw-chart/css/detail.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/rickshaw-chart/css/legend.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/rickshaw-chart/css/extensions.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/rickshaw-chart/css/rickshaw.min.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/rickshaw-chart/css/lines.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/jvectormap/jquery-jvectormap-2.0.1.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/icheck/skins/minimal/white.css" rel="stylesheet" type="text/css" media="screen"/>        
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 

<link href="{{ $assetURL }}plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{ $assetURL }}plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="screen"/>

<!--link href="{{ $assetURL }}plugins/datepicker/css/datepicker.css" rel="stylesheet" type="text/css" media="screen"/-->>
<link href="{{ $assetURL }}plugins/daterangepicker/css/daterangepicker-bs3.css" rel="stylesheet" type="text/css" media="screen"/>
<!--link href="{{ $assetURL }}plugins/timepicker/css/timepicker.css" rel="stylesheet" type="text/css" media="screen"/-->
<link href="{{ $assetURL }}plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen"/>
        
<link href="{{ $assetURL }}plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" media="screen"/>

<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
<link href="{{ $assetURL }}plugins/prettyphoto/prettyPhoto.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ $assetURL }}plugins/bootstrap-multiselect/css/bootstrap-multiselect.css" type="text/css">

<!-- CORE CSS TEMPLATE - START -->
<link href="{{ $assetURL }}css/style.css" rel="stylesheet" type="text/css"/>
<link href="{{ $assetURL }}css/responsive.css" rel="stylesheet" type="text/css"/>
<!-- CORE CSS TEMPLATE - END -->

<!-- Script Editor -->
<script type="text/javascript" charset="utf-8" src="{{ $assetURL }}editor/kindeditor.js"></script>

<script>
var base_url = "<?php echo url('/')?>";
var CONTROLLER = "<?=CONTROLLER?>";
</script>

<script src="{{ $assetURL }}scripts/jquery-1.11.2.min.js" type="text/javascript"></script>

<meta name="csrf-token" content="<?php echo csrf_token() ?>"/>

