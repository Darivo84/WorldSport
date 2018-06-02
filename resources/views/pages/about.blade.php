@extends('layout')
@section('content')

{{--    {!! Breadcrumbs::render('about') !!}--}}

    <div class="banner"><img src="{{ $about->cover_img }}" class="about_banner_img"></div>

    <div class="blue_block">
        <h1 class="heading_white">{{ $about->title }}</h1>

        <p>{{ $about->subtitle }}</p>
    </div>

    <section class="about_events">
        <div class="about_events_box">
            <img src="{{ $about->events_img }}" class="about_events_img desktop">
            <img src="{{ $about->events_img_mobi }}" class="about_events_img mobile">
            <p class="events_copy_mobi">From the Volvo Ocean Race to The Music Run, from horseraces to air shows--
                                        WORLDSPORT events deliver measurable results for its partners against a range of
                                        strategic objectives: economic impact and development, direct commercial return,
                                        destination marketing, brand and consumer engagement, community and youth
                                        development, and CSI project fundraising.
            </p>
            <a href="/major-international-events" class="about-mie">
                <!-- <p class="heading">MAJOR INTERNATIONAL EVENTS</p>
                <p class="para">
                    Global event properties which use high-level Host City public/private sector partnerships to
                    deliver broad-based economic impact destination marketing and social development impact.
                </p> -->
            </a>

            <a href="/brand-experiences" class="about-brands">
                <!-- <p class="heading">BRAND EXPERIENTIAL EVENTS</p>
                <p class="para">
                    Innovative event-based engagement programmes using a core lifestyle activity to showcase
                    your brand and products to target consumers.
                </p> -->
            </a>

            <a href="/destination-festivals" class="about-des">
                <!-- <p class="heading">DESTINATION FESTIVALS</p>
                <p class="para">
                    Vibrant, content-driven lifestyle festivals designed to offer a mix of immersive activities
                    to a range of fans and families who want truly experience the destination and its partner consumer brands.
                </p> -->
            </a>
        </div>
    </section>

    <section class="about_do">
        <div class="about_do_box">
            {{--			<h3 class="heading_white">What we do</h3>--}}
            <div class="about_what_we_do">
                <div>
                    <!-- <p>
                        WORLDSPORT occupies a range of agency roles and business positions around the events with which it partners.
                        Each role provides different revenue models and remuneration structures for WORLDSPORT as an agency.
                    </p>

                    <ul>
                        <li>Equity stakes</li>
                        <li>Annual profit dividends</li>
                        <li>Commercial revenue shares</li>
                        <li>Sales commissions</li>
                        <li>Project management fees</li>
                    </ul>

                    <p>
                        WORLDSPORT works with its partners on a case-by-case basis to define and apply the combination of roles and
                        remuneration structures that will deliver the best strategic, commercial and operational results for the event and its clients.
                    </p> -->

                    {!! $about->what_we_do !!}
                </div>
            </div>

        </div>
    </section>

    <style>
        .about_do {
            background: url('{{ $about->footer_img }}') no-repeat center center;
            background-size: cover;
        }
    </style>

@endsection