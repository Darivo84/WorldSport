@extends('admin.layout')
@section('content')

@if(isset($user->first_name))
	<div class="dashboard_container">
		<h1 class="blue_heading">Welcome {{$user->first_name}}</h1>
	
		<p>
			Welcome to the Content Management System (CMS) of Worldsports. 
		</p>

		<p>Should you experience any issues please contact <a href="mailto:kyle@optimalonline.co.za" class="blue_underline">kyle@optimalonline.co.za</a></p>
	</div>
@endif

@endsection