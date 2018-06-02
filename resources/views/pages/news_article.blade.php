@extends('layout')
@section('content')

	<section class="clearfix">
		<section class="article_left">
			<div class="article_banner"><img src="{{ $news->banner }}"></div>

			<div class="article_box">
				<h4 class="article_title">{{ $news->title }}</h4>
				<hr>
				<span style="margin-bottom: 20px;display: block;">{{$news->date}}</span>

				{!! $news->description !!}

				<div class="article_links clearfix">
					@if(isset($previous) && !empty($previous))
					<a href="/news/{{ $previous->id }}/{{ $previous->url }}" class="article_prev"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
					@endif
					@if(isset($next) && !empty($next))
					<a href="/news/{{ $next->id }}/{{ $next->url }}" class="article_next">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					@endif
				</div>
			</div>
		</section>

		<section class="article_right">
			<h3 class="heading_white">More Articles</h3>

			@foreach($news_articles as $key => $value)
				<?php 
					$url = str_replace(' ', '-', strtolower($value->title));
				?>
				<div class="more_article">
					<a href="/news/{{ $value->id }}/{{ $url }}">
						<div class="ma_date">{{ $value->date }}</div>
						<p class="ma_des">{{ strip_tags(strtoupper(str_limit($value->title,40))) }}</p>
					</a>
				</div>
			@endforeach
		</section>
	</section>

	<script>
		$(document).ready(function() {

			$(window).resize(function() {
				var h = $('.article_left').height();
				$('.article_right').css({height:h});
			});

			var h = $('.article_left').height();
			$('.article_right').css({height:h});

			$('.nav_box a[href="/news"]').addClass('nav_active_news');

		});
	</script>

@endsection