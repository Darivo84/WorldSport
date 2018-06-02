<!doctype html>
<html lang="en">
<head>
    <title>Worldsport</title>
    <meta name="title" content="Optimal Online"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/font-awesome-4.6.3/css/font-awesome.min.css">
    <!-- bxSlider CSS file -->
    <link href="/bxslider/jquery.bxslider.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/sss/sss.css">

    <link rel="stylesheet" href="/packery-docs/css/packery-docs.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">

    @if(isset($site_id) && $site_id == 1)
        <link href="/images/favicon.png" rel="shortcut icon" type="image/x-icon">
    @elseif(isset($site_id) && $site_id == 2)
        <link href="/images/favicon-sa.png" rel="shortcut icon" type="image/x-icon">
    @endif

<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>

    <link href="https://plus.google.com/u/2/b/115967342606210053551/115967342606210053551/about?gmbpt=true&hl=en"
          rel="publisher"/>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

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

    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="layout_body">

@include("partials/header")

<section id="main_content_container" class="main_content_container">
    @yield("content")
</section>

@include("partials/footer")

<!-- JS -->
<script src="/js/jquery-ui.min.js" type="text/javascript"></script>

<!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->

<!-- Validation -->
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>

<!-- bxSlider Javascript file -->
<script src="/bxslider/jquery.bxslider.min.js"></script>

<script src="/sss/sss.js" type="text/javascript"></script>

<script src="/packery-docs/js/packery-docs.min.js"></script>

<script>
    $(document).ready(function () {
        var pathname = window.location.pathname;
        //console.log(pathname);

        $('.nav_box a').removeClass('nav_active');
        $('.nav_box a[href^="' + pathname + '"]').addClass('nav_active');
    });
</script>

</body>
</html>