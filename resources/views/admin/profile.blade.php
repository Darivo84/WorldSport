@extends('admin.layout')
@section('content')
<div class="admin_header_wrapper">
<div class="admin_header_left">
<h3 class="admin_header">Update your profile</h3>
</div>
<div class="admin_header_right">

</div>
</div>

@if (count($errors) > 0)
    <div class="alert adjusted alert-error">
            @foreach ($errors->all() as $error)
                <i class="fa fa-exclamation-triangle"></i>
                        <strong>Error:</strong> {!! $error !!}<br>
            @endforeach
    </div>
@endif

@if(Session::has('message'))
    <div class="alert adjusted alert-success">
        <!-- <button class="close" data-dismiss="alert">×</button> -->
        <i class="fa fa-check-square-o"></i>
        <strong>Success: </strong> {{Session::get('message')}}
    </div>
@endif

<div class="admin_form_container">
<div class="admin_form">
{!! Form::model($user,array('url' => '/dashboard/profile')) !!}
    <div>
        Name
    </div>
    <div>
        {!! Form::text('first_name') !!}
    </div>
    <div>
        Surname
    </div>
    <div>
        {!! Form::text('last_name') !!}
    </div>
    <div>
        Email
    </div>
    <div>
        {!! Form::text('email') !!}
    </div>
    <div>
        Password
    </div>
    <div>
        {!! Form::password('password') !!}
    </div>
    <div>
        {!! Form::submit('Update') !!}
    </div>
{!! Form::close() !!}
</div>
</div>

<script>
//Set the active menu state
$( document ).ready(function() {
	$("#profile").addClass('active');
});
</script>
@endsection