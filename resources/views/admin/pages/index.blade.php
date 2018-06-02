@extends('admin.layout')
@section('content')
    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i> Pages
                <i class="fa fa-angle-right" aria-hidden="true"></i> {{ $page->name }}
            </h2>
        </div>

        <div class="section-content">
            @if(in_array('create_news', $user->permissions()))
                <div class="add-box">
                    <a href="{{'/dashboard/pages/update/' . $page->page_id}}" class="input-btn" id="add_file">
                        <span class="btn-blue">Update</span>
                    </a>
                </div>
            @endif

            <div class="notification-box">
                @if(Session::has('success'))
                    <div class="success_box"><i class="fa fa-check"></i> {{ Session::get('success') }}</div>

                    <script>
                        setTimeout(function () {
                            $(document).ready(function () {
                                $('.success_box').fadeOut(600);
                            });
                        }, 3000);
                    </script>
                @endif
            </div>

            <div class="page-banner">
                <img src="{{ $page->cover_img ? $page->cover_img :  '/images/no-preview-big.jpg'}}"
                     alt="" class="upload-preview">
            </div>

            <div class="page-content">
                <h4>Title:</h4>
                <p>{{ $page->title }}</p>
                <h4>Subtitle:</h4>
                <p>{!! $page->sub_title !!}</p>

                @if(isset($features_slider) && $features_slider->count() > 0)
                    <h4>Features Slider</h4>
                    <ul>
                        @foreach($features_slider as $feature)
                            <li> - {{$feature->description}}</li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            // SET NAV
                $("#pages").addClass('open');
                $("#pages").children('ul').slideDown();              
                //$("#about").addClass('active'); 
        });
    </script>
@endsection