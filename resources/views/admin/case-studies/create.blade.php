@extends('admin.layout')
@section('content')

    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Case Studies
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

                    <form action="{{route('admin_case_studies_insert')}}" method="post" class="admin-form"
                          id="case-study-create-form"
                          enctype="multipart/form-data">
                        <fieldset class="">
                            <legend>New Case Study:</legend>

                            <div class="form-group">
                                <label for="news-title">Title:</label>
                                <input type="text" name="title" id="news-title" class="form-input-full"
                                       value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label for="event_page">Select Client:</label>
                                <select class="form-input-full" name="client">
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="event_page">Select Layout:</label>
                                <p style="display: inline-block; padding-right:10px;">
                                    <img src="/images/option1.jpg" style="width:100px;"><br>
                                    <small>300px by 200px</small>
                                    <br>
                                    Option 1: <input type="radio" name="width" value="0" checked>
                                </p>

                                <p style="display: inline-block; padding-right:10px;">
                                    <img src="/images/option2.jpg" style="width:100px;"><br>
                                    <small>600px by 200px</small>
                                    <br>
                                    Option 2: <input type="radio" name="width" value="1">
                                </p>

                                <p style="display: inline-block;">
                                    <img src="/images/option3.jpg" style="width:100px;"><br>
                                    <small>900px by 200px</small>
                                    <br>
                                    Option 3: <input type="radio" name="width" value="2">
                                </p>
                                <div class="form-group">
                                    <label for="news-title">Case Study Image:</label>
                                    <input type="file" name="cs_image" id="cs_image" class="form-input-full">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="event_page" style="display: inline-block; margin-right: 10px;">Select
                                                                                                           Categories:</label><span
                                        style="font-size: 14px; color: #707070;"> (To add a category, select one from the drop down list and click the add category button below.)</span>
                                <select class="form-input-full" name="event_page" id="page_value">
                                    @foreach($pages as $page)
                                        @if($page->page_id != 8 && $page->page_id != 7  )
                                            <option value="{{ $page->page_id }}" class="page_item"
                                                    data-name="{{ $page->name }}">{{ $page->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="add_category_btn">Add Category</span>
                            </div>

                            <div class="current_pages">
                                <div class="form-group">
                                    <label for="event_page" style="display: inline-block; margin-right: 10px;">Selected
                                                                                                               Categories:</label><span
                                            style="font-size: 14px; color: #707070;"> (To remove a category, click on the red trash icon to the right.)</span>
                                    <p>Nothing slected.</p>
                                </div>
                            </div>

                            <script>
                                $('.add_category_btn').click(function () {

                                    var val = $('#page_value').find(':selected');

                                    console.log(val);

                                    var form_group = $('<div class="form-group feature-add-title-container">');
                                    var input = $('<input readonly id="feature-add-title" class="form-input-full" value="' + val.data('name') + '" />');
                                    var input_hidden = $('<input type="hidden" name="page_id[]" class="form-input-full" value="' + val.val() + '" />');
                                    var btn_delete = '<span class="delete-feature-btn"><i class="fa fa-trash" aria-hidden="true"></i></span>';


                                    $('.current_pages').append(form_group.append(input).append(input_hidden).append(btn_delete));

                                });

                                $(document).on('click', '.delete-feature-btn', function () {
                                    $(this).parent().remove();
                                });
                            </script>

                            <div class="form-group">
                                <label for="news-title">Cover Image:</label>
                                <p>
                                    <small>Optimal photo dimensions: 1000 pixels by 260 pixels landscape</small>
                                </p>
                                <input type="file" name="cover_image" id="cover_image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">Brand Image:</label>
                                <p>
                                    <small>Optimal photo dimensions: 300 pixels by 300 pixels</small>
                                </p>
                                <input type="file" name="brand_image" id="brand_image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">Information Image:</label>
                                <p>
                                    <small>Optimal photo dimensions: 960 pixels by 430 pixels landscape</small>
                                </p>
                                <input type="file" name="info_image" id="info_image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">Information Image Mobile:</label>
                                <p>
                                    <small>Optimal photo dimensions: 500 pixels width portrait</small>
                                </p>
                                <input type="file" name="info_image_mobi" id="info_image_mobi" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">Description:</label>
                                <textarea name="description" id="news-title" cols="30"
                                          rows="10">{{old('description')}}</textarea>
                            </div>

                            <h4>Digital Links</h4>
                            <div class="form-group">
                                <label for="web_url">Web:</label>
                                <input type="text" name="web_url" id="web_url" class="form-input-full"
                                       value="{{old('web_url')}}">
                            </div>

                            <div class="form-group">
                                <label for="facebook_url">Facebook:</label>
                                <input type="text" name="facebook_url" id="facebook_url" class="form-input-full"
                                       value="{{old('facebook_url')}}">
                            </div>

                            <div class="form-group">
                                <label for="twitter_url">Twitter:</label>
                                <input type="text" name="twitter_url" id="twitter_url" class="form-input-full"
                                       value="{{old('twitter_url')}}">
                            </div>

                            <div class="form-group">
                                <label for="instagram_url">Instagram:</label>
                                <input type="text" name="instagram_url" id="instagram_url" class="form-input-full"
                                       value="{{old('instagram_url')}}">
                            </div>

                            <div class="form-group">
                                <label for="pinterest_url">Pinterest:</label>
                                <input type="text" name="pinterest_url" id="pinterest_url" class="form-input-full"
                                       value="{{old('pinterest_url')}}">
                            </div>

                            <div class="form-group clearfix">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" value="Post" class="btn-blue  push-right">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            {{--            <script>
                            $.validator.addMethod('filesize', function (value, element, param) {
                                return this.optional(element) || (element.files[0].size <= param)
                            }, 'File size must be less than {0} mb');

                            jQuery(function ($) {
                                "use strict";
                                $('#case-study-create-form').validate({
                                    rules: {
                                        cs_image: {
                                            required: true,
                                            extension: "jpg,jpeg",
                                            filesize: 2
                                        }
                                    }
                                });
                            });
                        </script>--}}

            <div class="preview-pane">

                <div class="cover_image_container">
                    <h4 style="text-align: left">Cover Image</h4>
                    <img src="/images/no-preview-big.jpg"
                         alt="" class="cover-preview">
                </div>

                <div class="brand_image_container">
                    <h4 style="text-align: left">Brand Image</h4>
                    <img src="/images/no-preview-big.jpg"
                         alt="" class="brand-preview">
                </div>

                <div class="info_image_container">
                    <h4 style="text-align: left">Information Image</h4>
                    <img src="/images/no-preview-big.jpg"
                         alt="" class="info-preview">
                </div>

                <h4 style="text-align: left; margin-top: 30px; margin-bottom: 10px;">File Info</h4>
                <ul style="text-align: left;">
                    <li style="margin-bottom: 8px;">Max file size: 2mb.</li>
                    <li style="margin-bottom: 8px;">Supported File Types: jpg,jpeg,tif,png,gif</li>
                </ul>
            </div>
        </div>
    </section>
    <script>

        function readURL(input, type) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var el = $('.' + type + '-preview');

                    console.log(el);
                    el.attr('src', e.target.result);

                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#cover_image").change(function () {
            readURL(this, 'cover');
        });

        $("#brand_image").change(function () {
            readURL(this, 'brand');
        });


        $("#info_image").change(function () {
            readURL(this, 'info');
        });

        $(document).ready(function () {
            //Set the active menu state
            CKEDITOR.replace('description');

            // SET NAV
            $("#case_study").addClass('open');
            $("#case_study").children('ul').slideDown();
            $("#case_study_new").addClass('active');
        });
    </script>
@endsection