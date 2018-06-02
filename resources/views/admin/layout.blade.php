<!DOCTYPE html>
<html>
<head>
	<title>Worldsports - Dashboard</title>
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
	<link rel="stylesheet" type="text/css" href="/css/nav.css">
	<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/datatables/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="/datatables/css/buttons.dataTables.min.css">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="/js/nav.js"></script>
	<script src="/js/jquery-ui.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">

	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>

	<!-- REMODAL -->        
    <link href="/remodal/remodal.css" rel="stylesheet" />
    <link href="/remodal/remodal-default-theme.css" rel="stylesheet" />
    <script src="/remodal/remodal.min.js"></script>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    @if(isset($user->site_id) && $user->site_id == 1)
    <link href="/images/favicon.png" rel="shortcut icon" type="image/x-icon">
	@elseif(isset($user->site_id) && $user->site_id == 2)
	<link href="/images/favicon-sa.png" rel="shortcut icon" type="image/x-icon">
	@endif

	<script src="/ckeditor/ckeditor.js"></script>
</head>
<body>
<div>
	@section('sidebar')
		<div class='sidebar'>
        	@include("admin/nav")
        </div>
    @show

    <div class="content_container">
        @yield('content')
    </div>
</div>

<script src="/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="/datatables/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/datatables/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="/datatables/js/buttons.html5.min.js" type="text/javascript"></script>

</body>
</html>