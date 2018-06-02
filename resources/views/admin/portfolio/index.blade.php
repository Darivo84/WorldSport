@extends('admin.layout')
@section('content')

    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Portfolio
            </h2>
        </div>

        @if(in_array('create_news', $user->permissions()))
            <div class="add-box">
                <a href="" class="input-btn" id="add_file">
                    <span class="btn-blue">Update</span>
                </a>
            </div>
        @endif
    </section>

    <script>
        $(document).ready(function(){
            // SET NAV
                $("#pages").addClass('open');
                $("#pages").children('ul').slideDown();              
                $("#portfolio").addClass('active'); 
        });
    </script>

@endsection