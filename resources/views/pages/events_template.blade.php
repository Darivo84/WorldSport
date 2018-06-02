@extends('layout')
@section('content')
{{--	{!! Breadcrumbs::render('major-international-events') !!}--}}
	<div class="banner"><img src="{{ $page->cover_img }}" class="about_banner_img"></div>

	<div class="white_block">
		<h1 class="heading_blue">{!! $page->title !!}</h1>

			<p>{!! strip_tags($page->sub_title )!!}</p>


	</div>

	<section class="text_slider {{ $page_class }}">
		<ul class="bxslider bx_text_slider">
			@foreach($features_slider as $key => $value)
				<li>{!! $value->description !!}</li>
			@endforeach
		</ul>
	</section>

	<section class="event_offer clearfix">
		<div class="event_right image_slider">
			<ul class="bxslider bx_image_slider">
				@foreach($offer_slides as $key => $value)
					<li style="background:url('{{ $value->image_path }}') no-repeat center center; background-size:cover;"></li>
				@endforeach
			</ul>
		</div>

		<div class="event_left {{ $page_class }}">
			<h3 class="heading_white">What does WORLDSPORT offer?</h3>
			<div class="what_we_do">
				<div>
					<!-- <li>Top-level Strategy Development</li>
					<li>Bid Management– including venue evaluation & selection, organizational capacity evaluation, financial modeling and bid book creation.</li>
					<li>Hosting Agreement Negotiation</li>
					<li>International Rights Owner/Federation Management</li>
					<li>Stakeholder Engagement & Coordination [LOC]</li>
					<li>Funding/Commercial Partner Procurement & Servicing</li>
					<li>Turn-key Project Delivery Management</li>
					<li>Total Project Accounts Management and Audit Reporting</li>
					<li>Impact Monitoring & Reporting</li> -->
					{!! $page->what_we_do !!}
				</div>
			</div>
		</div>		
	</section>

	<section class="case_study">
		<h3 class="heading_blue">CASE STUDIES</h3>
		<p class="case_subheading">SCROLL OVER IMAGE TO VIEW MORE INFORMATION</p>

		<div class="clearfix case_gallery grid">
		<?php 
					
				function seoUrl($string) {
				//Lower case everything
				$string = strtolower($string);
				//Make alphanumeric (removes all other characters)
				$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
				//Clean up multiple dashes or whitespaces
				$string = preg_replace("/[\s-]+/", " ", $string);
				//Convert whitespaces and underscore to dash
				$string = preg_replace("/[\s_]/", "-", $string);
				return $string;
				}
			?>
			<!-- <div class="grid-sizer"></div> -->

			@foreach($case_studies as $key => $value)
				<?php
					if($value->width == 1)
						$case_class = 'grid-item--width2';
					elseif($value->width == 2)
						$case_class = 'grid-item--width3';
					else
						$case_class = '';
				?>
				<div class="case_item grid-item {{ $case_class }}">
					<img src="{{ $value->cs_img_url }}">
					<div class="case_overlay">
						<div class="case_overlay_middle">
							<img src="{{ $value->brand_img_url }}">
							<p>{!! $value->title !!}</p>
							<?php 
								$description = $value->description;
      							$smallDescription = strip_tags(substr($description, 0,45));
							?>
							<em>{{ $smallDescription }}...</em>
						</div>
						<?php
						$portfolio_title = seoUrl($value->title);
						?>
						<a href="{{ route('portfolio_individual', [$value->id, $portfolio_title]) }}" class="case_read_more">Read more</a>
					</div>
				</div>
			@endforeach
		</div>
	</section>

	<script>
		$(document).ready(function() {
			var bx_image_slider = $('.bx_image_slider').bxSlider({
				adaptiveHeight: true,
				infiniteLoop: true,
                auto: true
			});



			var bx_text_slider = $('.bx_text_slider').bxSlider({
				adaptiveHeight: true,
				infiniteLoop: true,
                auto: true
			});

			$('.slider').sss();

			if($(window).width() < 801)
				$('.event_right').css({'height':'auto'});
			else {
				var event_left = $('.event_left').outerHeight();
				$('.event_right').height(event_left);
			}

			$(window).resize(function() {
				if($(window).width() < 801)
					$('.event_right').css({'height':'auto'});
				else {
					var event_left = $('.event_left').outerHeight();
					$('.event_right').height(event_left);
				}

				bx_image_slider.reloadSlider();
				bx_text_slider.reloadSlider();
				
			});

			$('.case_item').on('mouseover', function(){
				$(this).children('div.case_overlay').show();
			});

			$('.case_item').on('mouseout', function(){
				$(this).children('div.case_overlay').hide();
			});

			// $('.grid').packery({
			//   // options
			//   percentPosition: true,
			//   itemSelector: '.grid-item',
			//   gutter: 20
			// });

			var $container = $('.grid');
			// initialize Packery after all images have loaded
			$container.imagesLoaded( function() {
				$container.packery({
				// options...
					percentPosition: true,
					itemSelector: '.grid-item',
					gutter: 20
				});
			});

		})
	</script>

@endsection