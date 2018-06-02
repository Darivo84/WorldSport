@extends('layout')
@section('content')

	<div class="banner"><img src="{{ $page->cover_img }}" class="about_banner_img"></div>

	<div class="white_block">
		<p>


			{{ strip_tags($page->sub_title )}}
		</p>
	</div>

	<section class="case_study clearfix">

		<form id="portfolio_search" class="portfolio_search" name="portfolio_search" method="POST">

			<input type="hidden" name="_token" value="{{csrf_token()}}">

			<select name="client" class="select client">
				<option selected value="c">Client</option>
				@foreach($clients as $key => $value)
					<option value="{{ $value->id }}">{{ $value->name }}</option>
				@endforeach
			</select>

			<select name="event_type" class="select event_type">
				<option selected value="e">Event Type</option>				
				<option value="1">Major International Events</option>
				<option value="2">Brand Experiences</option>
				<option value="3">Destination Festivals</option>				
			</select>

			<label for="view_all" class="view_all">
				<input type="checkbox" id="view_all" name="view_all" value="view_all"> View all
			</label>

		</form>

		<p class="case_subheading">SCROLL OVER IMAGE TO VIEW MORE INFORMATION</p>

		<p class="none_error" style="display:none;text-align:center;">No case studies</p>

		<div class="clearfix case_gallery grid" data-packery='{ "itemSelector": ".grid-item", "gutter": 20, "percentPosition": true }' >
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
      							$smallDescription = strip_tags(substr($description, 0, 70));
							?>
						{{--	<em>{{ $smallDescription }}...</em>--}}
						</div>
						<?php
						$portfolio_title = seoUrl($value->title);
						?>
						<a href="{{ route('portfolio_individual', [$value->id, $portfolio_title]) }}" class="case_read_more">Read more</a>
					</div>
				</div>
			@endforeach
		</div>
		<br>
	</section>

	<script>
		$(document).ready(function() {
			$('.bxslider').bxSlider();
			$('.slider').sss();

            function strip_tags(str) {
                str = str.toString();
                return str.replace(/<\/?[^>]+>/gi, '');
            }

			$('.case_item').on('mouseover', function(){
				$(this).children('div.case_overlay').show();
			});

			$('.case_item').on('mouseout', function(){
				$(this).children('div.case_overlay').hide();
			});
			
			//$('div.grid-item--width2').next().css({'margin-right':0});			

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
					gutter: 20,

				});
			});

			$('.view_all, #view_all').on('click', function() {
				location.reload();
			});

			$('.select').on('change', function() {
				var client = $('.client').val();
				var event_type = $('.event_type').val();

				$.ajax({
			        type: "GET",
			        url: '/portfolio-search/'+client+'/'+event_type, 
			        data: {
			        "_token": "{{ csrf_token() }}"
			        }
			      }).success(function(data) {

			      	//alert('success');
			      	//console.log(data);

			      	if(data != null) {
			      		$('.none_error').hide();

			      		$('.case_gallery').empty();

			      		var appendHtml = '';

			      		$.each(data, function(key, value) {

			      			if(value['width'] == 1) {
			      				case_class = 'grid-item--width2';			      			
			      			}
			      			else if(value['width'] == 2){
			      				case_class = 'grid-item--width3';
			      			} else {
			      				case_class = '';
			      			}

			      			console.log(value);
						var portfolio_title = value['title'];
						portfolio_title = portfolio_title.replace(/\s+/g, '-').toLowerCase(); //new object assigned to var str

							appendHtml += '<div class="case_item grid-item '+case_class+'"><img src="'+ value['cs_img_url'] +'"><div class="case_overlay">';
							appendHtml += '<div class="case_overlay_middle"><img src="'+value['brand_img_url']+'"><p>'+value['title']+'</p>';
							appendHtml += '<em>'+ strip_tags(value['description']).substring(0,45) +'...</em></div><a href="/portfolio/'+value['id']+'/'+portfolio_title+'" class="case_read_more">Read more</a></div></div>';
						});

						var $container = $('.grid').packery();
			            var $html = $(appendHtml);
			            $container.append( $html );
			            setTimeout(function(){
                            $container.packery( 'appended', $html );
						},50);


			            if($html.length == 0) {
			            	$('.none_error').text('No case studies').show();
			            }

                    	$('.case_item').on('mouseover', function(){
							$(this).children('div.case_overlay').show();
						});

						$('.case_item').on('mouseout', function(){
							$(this).children('div.case_overlay').hide();
						});

			      	} else {
			      		$('.none_error').text('No case studies').show();
			      		$('.case_gallery').empty();
			      	}

			      }).fail(function(data) {
			        //alert('fail');
			        //console.log(data);
			        $('.none_error').text('Please try again').show();
			      });
			});

		})
	</script>

@endsection