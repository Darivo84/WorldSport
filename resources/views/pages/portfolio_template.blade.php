@extends('layout')
@section('content')

    <div class="banner"><img src="{{ $casestudy->cover_img_url }}" class="about_banner_img"></div>

    <div class="blue_block clearfix our-involvement">

        <img src="{{ $casestudy->brand_img_url }}" class="portfolio_logo_mobi">

        <div class="portfolio_involvement clearfix">
            <div class="our_involvement_left">
                <img src="{{ $casestudy->brand_img_url }}" class="portfolio_logo">
            </div>

            <div class="our_involvement_right">
                <h3 class="heading_white"><i class="fa fa-sort-desc mobile tablet heading_white_trigger"
                                             aria-hidden="true" style="padding-top: 13px;"></i></h3>
                <h3 class="case_study_heading c_s_h">{{ $casestudy->title }}</h3>
                <div class="portfolio_investment_content">
                    <p>{!! $casestudy->description !!}</p>

                    @if($casestudy->web_url != null ||$casestudy->facebook_url != null ||$casestudy->twitter_url != null ||$casestudy->instagram_url != null )
                        <div class="cs_social">
                            <h4 style="font-size: 16px;">Digital</h4>
                            @if($casestudy->web_url != null )
                                <a href="{{$casestudy->web_url}}" class="digital_link" target="_blank"><i
                                            class="fa fa-external-link-square" aria-hidden="true"></i></a>
                            @endif
                            @if($casestudy->facebook_url != null )
                                <a href="{{$casestudy->facebook_url}}" class="digital_link" target="_blank"><i
                                            class="fa fa-facebook-official" aria-hidden="true"></i></a>
                            @endif
                            @if($casestudy->twitter_url != null )
                                <a href="{{$casestudy->twitter_url}}" class="digital_link" target="_blank"><i
                                            class="fa fa-twitter-square" aria-hidden="true"></i></a>
                            @endif
                            @if($casestudy->instagram_url != null )
                                <a href="{{$casestudy->instagram_url}}" class="digital_link" target="_blank"><i
                                            class="fa fa-instagram" aria-hidden="true"></i></a>
                            @endif
                            @if($casestudy->pinterest_url != null )
                                <a href="{{$casestudy->pinterest_url}}" class="digital_link" target="_blank">
                                    <i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(isset($casestudy->info_img_url) && !empty($casestudy->info_img_url))
        <section class="about_events">
            <h2 class="heading_blue">Stats and Facts</h2>
            <div class="about_events_box">
                <img src="{{ $casestudy->info_img_url }}" class="about_events_img desktop">
                <img src="{{ $casestudy->info_img_mobi_url }}" class="about_events_img mobile">
            </div>
        </section>
    @endif

    @if(isset($gallery_images) && $gallery_images->count() > 0)
        <section class="portfolio_gallery">
            <div class="blue_block">
                <h3 class="heading_white">Gallery</h3>
            </div>

            <div class="gallery_box clearfix grid">
                @foreach($gallery_images as $key => $value)
                    <?php
                    if ($value->width == 1)
                        $case_class = 'grid-item--width2';
                    elseif ($value->width == 2)
                        $case_class = 'grid-item--width3';
                    else
                        $case_class = '';
                    ?>
                    <img src="{{ $value->image_url }}" class="gallery_item grid-item {{ $case_class }}">
                @endforeach
            </div>
        </section>
    @endif

    @if(isset($news) && $news->count() > 0)
        <section class="portfolio_news">
            <h3 class="heading_blue">News</h3>
            <div class="portfolio_news_box section clearfix">
                @foreach($news as $key => $value)

                    <?php
                    //var_dump($value->created_at); exit;
                    $y = date("Y", strtotime($value->created_at));
                    $m = date("M", strtotime($value->created_at));
                    $d = date("j", strtotime($value->created_at));
                    $url = str_replace(' ', '-', strtolower($value->title));
                    //$smallDescription = substr($description, 0, 120);
                    ?>

                    <a class="news_item" href="/news/{{ $value->id }}/{{ $url }}">
                        <img src="{{ $value->image }}">

                        {{--	<div class="news_date">{{ $d }} {{ $m }} <small>{{ $y }}</small></div>--}}
                        <div class="news_date">{{ $value->date }}</div>
                        <div class="news_summary">
                            <p class="news_sum_title">{{ str_limit($value->title, 60 )}}</p>
                            <div class="news_sum_des">{!! str_limit(strip_tags($value->description, 100 ))!!}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <script>
        $(document).ready(function () {

            $('.news_summary').mouseenter(function(){
                $(this).siblings('.news_item > img').css('opacity', '.5');
            });
            $('.news_summary').mouseleave(function(){
                $(this).siblings('.news_item > img').css('opacity', '1');
            });



            function involvementDropDown() {
                //console.log($(window).width());
                if ($(window).width() < 801) {
                    $('.portfolio_involvement h3').on('click', function () {
                        $('.portfolio_investment_content').toggle();
                    });
                }
            }

            involvementDropDown();

            $(window).resize(function () {
                involvementDropDown();
            });

            $('.case_item').on('mouseover', function () {
                $(this).children('div.case_overlay').show();
            });

            $('.case_item').on('mouseout', function () {
                $(this).children('div.case_overlay').hide();
            });

            var $container = $('.grid');
            // initialize Packery after all images have loaded
            $container.imagesLoaded(function () {
                $container.packery({
                    // options...
                    percentPosition: true,
                    itemSelector: '.grid-item',
                    gutter: 20,

                });
            });
        })
    </script>

@endsection