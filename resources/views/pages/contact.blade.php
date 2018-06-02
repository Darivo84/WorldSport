@extends('layout')
@section('content')

    <div class="notification-box">
        @if(Session::has('message'))
            <div class="success_box_frontend">{{ Session::get('message') }}</div>

            <script>
                setTimeout(function () {
                    $(document).ready(function () {
                        $('.success_box_frontend').fadeOut(700);
                    });
                }, 3000);
            </script>
        @endif

    <!-- ERRORS -->
        @if ( $errors->count() > 0 )
            <div id='error'>
                <p>The following errors have occurred:</p>

                @foreach( $errors->all() as $message )
                    <div class="alert box">
                        <i class="fa fa-ban"></i> {{ $message }}
                    </div>
                @endforeach
            </div>
            <div>
                <br class="clear-l">
            </div>
        @endif
    </div>
    <div class="banner">
    @if(isset($contact_info->google_map_link) && !empty($contact_info->google_map_link))
        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423812.56337978086!2d18.375879292635528!3d-33.91448199767813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcc500f8826eed7%3A0x687fe1fc2828aa87!2sCape+Town!5e0!3m2!1sen!2sza!4v1491200426580" width="100%" height="350" frameborder="0" style="border:0;width:100%;" allowfullscreen></iframe> -->
            {!! $contact_info->google_map_link !!}
            <style>
                iframe {
                    width: 100% !important;
                    height: 350px !important;
                }
            </style>
        @endif
    </div>

    <section class="contact">
        <h3 class="contact_title">{{ $contact_info->address }}</h3>

        <p>{{ strip_tags($contact_info->description) }}</p>

        <div class="contact_info">
            <span>M: <a href="{{ "tel: " .  $contact_info->tel  }}">{{ $contact_info->tel }}</a> </span>

            <span class=" e-mail contact_form_trigger" data-user=“SIRHC” data-website=“AE.TROPSDLROW”>{{ $contact_info->email }}</span>

        </div>
        <br>

        <div class="container_small">
            <div class="contact_form_container">
                <h2 style="text-align: center;color: #807F54">Contact Us</h2>
                <form action="{{ route('main_contact') }}" method="post">

                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name..." name="name" id="name">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email..." name="email" id="email">
                    </div>

                    <div class="form-group">
                        <textarea id="message" cols="30" rows="10" class="form-control" placeholder="Message..."
                                  name="message"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6Lfb2iIUAAAAAB48tMpdyZw5CaCpuBD-rTt_Vulu"></div>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" class="submit_btn">
                    </div>
                </form>
            </div>

            <script>
                $('.contact_form_trigger').click(function(){
                    $('.contact_form_container').slideToggle();
                });
            </script>
        </div>
        <br>

        {{--<ul class="contact_social">
            <li>
                @if(isset($contact_info->facebook_url) && !empty($contact_info->facebook_url))
                <a href="{{ $contact_info->facebook_url }}" class="sc_facebook" target="_blank">
                @else
                <a href="javascript:void(0);" class="sc_facebook" target="_blank">
                @endif
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-stack-2x" style="color:#fff;"></i>
                        <i class="fa fa-facebook-square fa-stack-1x" aria-hidden="true"></i>
                    </span>
                </a>
            </li>
            <li>
                @if(isset($contact_info->linked_in_url) && !empty($contact_info->linked_in_url))
                <a href="{{ $contact_info->linked_in_url }}" class="sc_linkedin" target="_blank">
                @else
                <a href="javascript:void(0);" class="sc_linkedin" target="_blank">
                @endif
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-square fa-stack-2x" style="color:#fff;"></i>
                        <i class="fa fa-linkedin-square fa-stack-1x" aria-hidden="true"></i>
                    </span>
                </a>
            </li>

        </ul>--}}


        @if($site_id == 1)
            <section class="social_contacts linkedin_active">

                <div class="sc_box clearfix" style="margin: 0 auto;">

                    @foreach($contacts as $key => $value)
                        <?php
                        $social_class = '';

                        if (isset($value->linkedin_url) && !empty($value->linkedin_url))
                            $social_class .= 'sc_linkedin ';
                        elseif (isset($value->facebook_url) && !empty($value->facebook_url))
                            $social_class .= 'sc_facebook ';
                        elseif (isset($value->google_url) && !empty($value->google_url))
                            $social_class .= 'sc_google';

                        //var_dump($social_class); exit;
                        ?>

                        <div class="sc_item {{ $social_class }}">
                            <div>
                                <img src="{{ $value->image }}" class="sc_imge">
                                @if(isset($value->linkedin_url) && !empty($value->linkedin_url))
                                    <span class="social_overlay linkedin_overlay">
									<a href="{{ $value->linkedin_url }}" target="_blank">
										<i class="fa fa-linkedin-square fa-5x" aria-hidden="true"></i>
										<p>Find {{ $value->first_name }} on Linkedin</p>
									</a>
								</span>
                                @endif
                                <?php
                                // @if(isset($value->facebook_url) && !empty($value->facebook_url))
                                // <span class="social_overlay facebook_overlay">
                                // 	<a href="{{ $value->facebook_url }}">
                                // 		<i class="fa fa-facebook-square fa-5x" aria-hidden="true"></i>
                                // 		<p>Find {{ $value->first_name }} on Facebook</p>
                                // 	</a>
                                // </span>
                                // @endif
                                // @if(isset($value->google_url) && !empty($value->google_url))
                                // <span class="social_overlay google_overlay">
                                // 	<a href="{{ $value->google_url }}">`
                                // 		<i class="fa fa-google-plus-square fa-5x" aria-hidden="true"></i>
                                // 		<p>Find {{ $value->first_name }} on Google Plus</p>
                                // 	</a>
                                // </span>
                                // @endif
                                ?>
                            </div>
                            <div class="sc_info">
                                <p class="sc_name">{{ $value->first_name }} {{ $value->last_name }}</p>
                                <p class="sc_title">{{ $value->title }}</p>
                             {{--   <p class="sc_email"><a href="mailto:{{ $value->email }}">{{ $value->email }}</a></p>--}}
                            </div>
                        </div>

                    @endforeach

                </div>

            </section>
        @endif
    </section>

    <script>
        $(document).ready(function () {

            // $('.contact_social li a').on('click', function() {
            // 	var sc_class = $(this).attr('class');

            // 	$('.sc_item').hide();
            // 	$('.sc_box .'+sc_class).show();

            // 	if(sc_class == 'sc_linkedin') {
            // 		$('.social_contacts').removeClass('facebook_active google_active').addClass('linkedin_active');
            // 	}
            // 	else if (sc_class == 'sc_facebook') {
            // 		$('.social_contacts').removeClass('google_active linkedin_active').addClass('facebook_active');
            // 	}
            // 	else if (sc_class == 'sc_google') {
            // 		$('.social_contacts').removeClass('facebook_active linkedin_active').addClass('google_active');
            // 	}

            // });

            $('.sc_item').on('mouseover', function () {

                //if($('.social_contacts').hasClass('linkedin_active')) {
                $(this).find('span.linkedin_overlay').show();
                // }
                // else if ($('.social_contacts').hasClass('facebook_active')) {
                // 	$(this).find('span.facebook_overlay').show();
                // }
                // else if ($('.social_contacts').hasClass('google_active')) {
                // 	$(this).find('span.google_overlay').show();
                // }

            });

            $('.sc_item').on('mouseout', function () {
                var sc_class = $('.social_contacts').attr('class');

                $(this).find('span.social_overlay').hide();

            });
        })
    </script>

@endsection