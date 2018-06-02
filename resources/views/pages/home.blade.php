<!doctype html>
<html lang="en">
	<head>
		<title>Worldsport</title>
		<meta name="title" content="Worldsport" />
		<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
		<!-- CSS -->		
		<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="/font-awesome-4.6.3/css/font-awesome.min.css">
		<!-- bxSlider CSS file -->
		<link href="/bxslider/jquery.bxslider.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="/sss/sss.css">

		<link rel="stylesheet" href="/packery-docs/css/packery-docs.css" media="screen">
		<link rel="stylesheet" type="text/css" href="/css/styles.css">

		@if(isset($site_id) && $site_id == 1)
	    <link href="/images/favicon.png" rel="shortcut icon" type="image/x-icon">
		@elseif(isset($site_id) && $site_id == 2)
		<link href="/images/favicon-sa.png" rel="shortcut icon" type="image/x-icon">
		@endif

		<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<link href="https://plus.google.com/u/2/b/115967342606210053551/115967342606210053551/about?gmbpt=true&hl=en" rel="publisher" />

	@if(isset($site_id) && $site_id == 1)
        <meta property="og:title" content="ARABIA'S LEADING DESTINATION EVENT COMMUNICATIONS AGENCY"/>
        <meta property="og:image" content="<?php echo url('/'); ?>/images/logo-black.png"/>
    @elseif(isset($site_id) && $site_id == 2)
        <meta property="og:title" content="SOUTH AFRICA'S LEADING DESTINATION EVENT COMMUNICATIONS AGENCY"/>
        <meta property="og:image" content="<?php echo url('/'); ?>/images/logosa-new.jpg"/>
    @endif

    <meta property="og:url" content="<?php echo url('/'); ?>"/>
    <meta property="og:site_name" content="Worldsport"/>
    <meta property="og:description"
          content="For over 20 years, WORLDSPORT has been providing clients across Africa and the Middle East with a full turnkey solution for developing and implementing innovative sport and lifestyle spectacles-- authentic destination experiences where targeted audiences can truly “live the brand”. "/>

    @if(isset($meta_tags) && !empty($meta_tags))
        <meta name="{!! $meta_tags->type !!}" content="{!! $meta_tags->content !!}">
    @else
        <meta name="description"
              content="For over 20 years, WORLDSPORT has been providing clients across Africa and the Middle East with a full turnkey solution for developing and implementing innovative sport and lifestyle spectacles-- authentic destination experiences where targeted audiences can truly “live the brand”. "/>
    @endif
    <meta name="keywords"
          content="innovative sport, lifestyle spectacles, authentic destination experiences, live events, tourism">
		
	</head>

	<body class="layout_body">

		@include("partials/header")

		<section id="main_content_container" class="main_content_container">
			<div class="full_slider">
				<ul class="bxslider">
					@foreach($home as $key => $value)
						<li style="background: url('{{ $value->image_path }}') center center no-repeat; background-size:cover;">
							<!-- <img src="{{ $value->image_path }}" class="full_slider_img"> -->
						</li>
					@endforeach
				</ul>

		{{--		<div class="home_slider_social">
					<ul>
						<li>	
							<a href="https://www.facebook.com/worldsportsouthafrica" target="_blank">		
								<span class="fa-stack fa-lg">
									<i class="fa fa-square fa-stack-2x" style="color:#fff;"></i>
									<i class="fa fa-facebook-square fa-stack-1x" aria-hidden="true"></i>
								</span>
							</a>
						</li>
						<li>			
							<a href="javascript:void(0);" target="_blank">
								<span class="fa-stack fa-lg">
									<i class="fa fa-square fa-stack-2x" style="color:#fff;"></i>
									<i class="fa fa-linkedin-square fa-stack-1x" aria-hidden="true"></i>
								</span>
							</a>
						</li>
						<!-- <li>			
							<span class="fa-stack fa-lg">
								<i class="fa fa-square fa-stack-2x" style="color:#fff;"></i>
								<i class="fa fa-google-plus-square fa-stack-1x" aria-hidden="true"></i>
							</span>
						</li> -->
					</ul>
				</div>--}}

			</div>
		</section>	

		<!-- JS -->
		<script src="/js/jquery-ui.min.js" type="text/javascript"></script>

		<!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->  

		<!-- Validation -->
		<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
		<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>

		<!-- bxSlider Javascript file -->
		<script src="/bxslider/jquery.bxslider.min.js"></script>

		<script src="/sss/sss.js" type="text/javascript"></script>

		<script>
			$(document).ready(function() {
				var slider = $('.bxslider').bxSlider({
					controls: false,
					auto: true,
					infiniteLoop: true
				});

				$(window).resize(function(){
					slider.reloadSlider();
				});

			});
		</script>

	@if($site_id == 1)
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-99791367-1', 'auto');
	ga('send', 'pageview');

	</script>
	@endif

	@if($site_id == 2)
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-101124979-1', 'auto');
	ga('send', 'pageview');
	</script>
	@endif

	</body>
</html>