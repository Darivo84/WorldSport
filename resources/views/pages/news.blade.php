@extends('layout')
@section('content')

	<div class="banner"><img src="{{ $page->cover_img }}" class="about_banner_img"></div>

	<section class="news_news">

		<div class="news_news_box section clearfix">
			@foreach($news as $key => $value)

			<?php 
				//var_dump($value->created_at); exit;
				$y = date("Y",strtotime($value->date));
				$m = date("M",strtotime($value->date));
				$d = date("j",strtotime($value->date));
				$url = str_replace(' ', '-', strtolower($value->title));
				//$smallDescription = substr($description, 0, 120);
			?>

			<a class="news_item" href="/news/{{ $value->id }}/{{ $url }}">
				<img src="{{ $value->image }}">
				
				<div class="news_date">{{ $d }} {{ $m }} <small>{{ $y }}</small></div>
				{{--<div class="news_date">	{{$value->date}}</div>--}}

				<div class="news_summary">
					<p class="news_sum_title">{{ str_limit($value->title, 60 )}}</p>
					<div class="news_sum_des">{!! str_limit(strip_tags($value->description, 100 ))!!}</div>
				</div>
			</a>

			@endforeach

		</div>
	</section>

@endsection