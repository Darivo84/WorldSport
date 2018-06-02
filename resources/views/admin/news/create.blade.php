@extends('admin.layout')
@section('content')

    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                News
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Create
            </h2>
        </div>

        <div class="section-content">
            <div class="notification-box">
                @if(Session::has('success'))
                    <div class="success_box"><i class="fa fa-check"></i>{{ Session::get('success') }}</div>

                    <script>
                        setTimeout(function () {
                            $(document).ready(function () {
                                $('.success_box').fadeOut(600);
                            });
                        }, 3000);

                    </script>
                @endif

            <!-- ERRORS -->
                @if ( $errors->count() > 0 )
                    <div id='error'>
                        <p>The following errors have occurred:</p>

                        @foreach( $errors->all() as $message )
                            <div class="alert box">
                                <i class="fa fa-ban"></i> {{ $message }}
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <br class="clear-l">
                    </div>
                @endif
            </div>

            <div class="left-container">
                <div class="form-container">

                    <form action="{{route('admin_news_insert')}}" method="post" class="admin-form"
                          enctype="multipart/form-data">
                        <fieldset class="">
                            <legend>New Article:</legend>

                            <div class="form-group">
                                <label for="news-title">Title:</label>
                                <input type="text" name="title" id="news-title" class="form-input-full"
                                       value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" name="date" id="date" class="form-input-full"
                                       value="{{old('date')}}">
                            </div>

                            <div class="form-group">
                                <label for="event_type">Select Event type:</label>
                                <select  class="form-input-full" name="event_type">

                                        <option value="1">Major International Events</option>
                                        <option value="2">Brand Experiences</option>
                                        <option value="3">Destination Festivals</option>
                                        <option value="4">Brands</option>
                                        <option value="5">Federations</option>
                                        <option value="6">Destinations</option>
                                        <option value="7">News</option>
                                        <option value="8">Portfolio</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="event_page">Select Case Study:</label>
                                <select  class="form-input-full" name="case_study_id">
                                    @foreach($case_studies as $case_study)
                                        <option value="{{ $case_study->id }}">{{ $case_study->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="news-title">Image:</label>
                                <p><small>Optimal photo dimensions: 740 pixels by 400 pixels landscape</small></p>
                                <input type="file" name="image" id="news-image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">News Banner:</label>
                                <p><small>Optimal photo dimensions: 1000 pixels by 260 pixels landscape</small></p>
                                <input type="file" name="banner" id="news-banner" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">Description:</label>
                                <textarea name="description" id="news-title" cols="30"
                                          rows="10">{{old('description')}}</textarea>
                            </div>

                            <div class="form-group clearfix">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" value="Post" class="btn-blue  push-right">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="preview-pane">
                <img src="/images/no-preview-big.jpg" alt="" class="upload-preview">
                <h4 style="text-align: left; margin-top: 30px; margin-bottom: 10px;">File Info</h4>
                <ul style="text-align: left;">
                    <li style="margin-bottom: 8px;">Max file size: 2mb.</li>
                    <li style="margin-bottom: 8px;">Supported File Types: jpg,jpeg,tif,png,gif</li>
                </ul>
            </div>
        </div>
    </section>
    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.upload-preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#news-image").change(function () {
            readURL(this);
        });

        $(document).ready(function () {
            //Set the active menu state
            CKEDITOR.replace('description');

            // SET NAV
                $("#news").addClass('open');
                $("#news").children('ul').slideDown();              
                $("#news_new").addClass('active');
        });
    </script>
@endsection