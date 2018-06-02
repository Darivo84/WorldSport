@extends('layout')
@section('content')

	<div class="banner"><img src="{{ $page->cover_img }}" class="about_banner_img"></div>

	<div class="blue_block pos_relative">
		<h3 class="heading_white">{!! $page->title !!}</h3>
		@if(isset($links) && !empty($links))
			<div class="other_partner_box clearfix" style="max-width: 70%; margin: 8px auto;">

				<a href="/our-partners/{{ $links[0] }}" class="other_partner_prev"><i class="fa fa-angle-left" aria-hidden="true" style="font-size: 25px;font-weight: 600;margin-right:14px;vertical-align:middle;"></i><span style="margin-top:2px;display: inline-block;vertical-align:middle;">{{ $links[0] }}</span></a>

				<a href="/our-partners/{{ $links[1] }}" class="other_partner_next"><span style="margin-top:2px;display: inline-block;vertical-align:middle;">{{ $links[1] }}</span><i class="fa fa-angle-right" aria-hidden="true" style="font-size: 25px;font-weight: 600;margin-left:14px;vertical-align:middle;"></i></a>

			</div>
		@endif
		<p>{!! $page->sub_title !!}</p>
	</div>

	<section class="partner_gallery">
		<h3 class="heading_blue">{!! $page->title !!} GALLERY</h3>

		<p class="case_subheading">SCROLL OVER IMAGE TO VIEW MORE INFORMATION</p>

		<div class="clearfix case_gallery partner_gallery_box grid">
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
      							$smallDescription = strip_tags(substr($description, 0, 45));
							?>
							<em>{{ $smallDescription }}...</em>
						</div>
						<?php
						$portfolio_title = seoUrl($value->title);
						?>
						<a href="{{ route('portfolio_individual', [$value->id, $portfolio_title]) }}" class="case_read_more">More</a>
					</div>
				</div>
			@endforeach

		</div>
		
	</section>

	<script>
		$(document).ready(function() {
			$('.bxslider').bxSlider();
			$('.slider').sss();


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