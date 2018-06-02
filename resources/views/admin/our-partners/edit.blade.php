@extends('admin.layout')
@section('content')


    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Our  Partners
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Update
            </h2>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            // SET NAV
                $("#pages").addClass('open');
                $("#pages").children('ul').slideDown();              
                $("#partners").addClass('active'); 
        });
    </script>

@endsection