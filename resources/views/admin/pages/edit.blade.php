@extends('admin.layout')
@section('content')

    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Pages
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                {{$page[0]->name}}
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Update
            </h2>
        </div>

        <div class="section-content clearfix">
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

            <div class="left-container clearfix">

                <div class="form-container">
                    <form action="{{'/dashboard/pages/update/' . $page[0]->page_id}}" method="post" class="admin-form"
                          enctype="multipart/form-data">
                        <fieldset>
                            <legend>Update Page:</legend>

                            <div class="form-group">
                                <label for="page-title">Title:</label>
                                <input type="text" name="title" id="page-title" class="form-input-full"
                                       value="{{$page[0]->title}}">
                            </div>

                            <div class="form-group">
                                <label for="page-cover-image">Cover Image:</label>
                                <p><small>Optimal photo dimensions: 1000 pixels by 260 pixels landscape</small></p>
                                <input type="file" name="cover_img" id="page-cover-image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="page-sub-title">Subtitle:</label>
                                <textarea name="sub_title" id="page-sub-title"
                                          style="width: 100%;box-sizing: border-box;font-family: Roboto;font-size: 16px;"
                                          rows="6">{{$page[0]->sub_title}}</textarea>
                            </div>

                            @if($page[0]->name == 'Major International Events' || $page[0]->name == 'Brand Experiences' || $page[0]->name == 'Destination Festivals')
                            <div class="form-group">
                                <label for="page-offer">What we offer:</label>
                                <textarea name="offer" id="page-offer" style="width: 100%;box-sizing: border-box;font-family: Roboto;font-size: 16px;" rows="6">
                                    {{$page[0]->what_we_do}}
                                </textarea>
                            </div>
                            <script>
                                /*CKEDITOR INIT */
                                $(document).ready(function () {
                                    //Set the active menu state
                                    CKEDITOR.replace('offer'); 
                                });
                                /*CKEDITOR INIT END*/
                            </script>
                            @endif

                            <div class="form-group clearfix">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" value="Update" class="btn-blue">
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div class="form-container">
                    @if(isset($slider_features) && $slider_features != null)
                    <form action="{{'/dashboard/pages/update/features-slider/' . $page[0]->page_id}}" method="post"
                          class="admin-form"
                          enctype="multipart/form-data">
                        <fieldset>
                            <legend>Update Features Slider:</legend>

                            <div class="form-group feature-add-title-container">
                                <label for="feature-add-title">Add Titles:</label>
                                <input type="text" name="feature-add-title" id="feature-add-title"
                                       class="form-input-full">
                                <span class="add-feature-btn"><i class="fa fa-plus" aria-hidden="true"></i></span>
                            </div>

                            <div class="featured-titles">
                                <p class="current-featured-titles">Current Titles:</p>
                                @foreach($slider_features as $feature)
                                    <div class="form-group feature-add-title-container">
                                        <input name="features[]" id="feature-add-title" class="form-input-full"
                                               value="{{ $feature->description }}"/>
                                        <span class="delete-feature-btn"><i class="fa fa-trash"
                                                                            aria-hidden="true"></i></span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group clearfix">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" value="Update" class="btn-blue">
                            </div>
                        </fieldset>
                    </form>
                        @endif
                </div>

                <div class="form-container">
                    @if(isset($offer_slider) && $offer_slider != null)
                        <fieldset>
                            <legend>Update Offer Image Slider:</legend>
                            <p style="margin-top:0;"><small>Optimal photo dimensions: 950 pixels by 430 pixels landscape</small></p>

                            <form action="{{url('/dashboard/pages/update/offer-slider/upload/' . $page[0]->page_id)}}"
                                  class="dropzone" id="addImages" method="post">

                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </form>
                            <br>
                            <div id="offer-slider-images">
                                @foreach($offer_slider as $slider)
                                    <div class="offer-slider-image">
                                        <div class="offer-image-overlay file_delete_modal" data-id="{{$slider->id}}"><i
                                                    class="fa fa-times-circle-o" aria-hidden="true"></i>Remove
                                        </div>
                                        <img class="img-thumbnail" src="{{ $slider->image_path }}">
                                    </div>
                                @endforeach
                            </div>
                        </fieldset>
                    @endif
                </div>
            </div>

            <div class="preview-pane">
                <img src="{{ $page[0]->cover_img ? $page[0]->cover_img :  '/images/no-preview-big.jpg'}}"
                     alt="" class="upload-preview">
                <h4 style="text-align: left; margin-top: 30px; margin-bottom: 10px;">File Info</h4>
                <ul style="text-align: left;">
                    <li style="margin-bottom: 8px;">Max file size: 2mb.</li>
                    <li style="margin-bottom: 8px;">Supported File Types: jpg,jpeg,tif,png,gif</li>
                </ul>
            </div>
        </div>

        <!-- START - FILE DELETE MODAL -->
        <div id="openModal_file_delete" class="modalDialog">
            <div>
                <a href="javascript:void(0);" title="Close" class="close" id="closeModal_file_delete">X</a>
                <h2>Are you sure you would like to delete this Event?</h2>

                <form action="/dashboard/pages/update/offer-slider/delete/" id="remove_event_form" method="post">
                    <button type="submit" data-id="" class="btn-red" id="modal_file_delete">Delete</button>
                    <button type="button" class="btn-blue" id="closeModal_file_delete_cancel">Cancel</button>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="event_remove_id" class="event_remove_id">
                </form>
            </div>
        </div>
        <!-- EMD - FILE DELETE MODAL -->

        <script>

            /*ADD FEATURE SLIDER TITLES START*/
            $('.add-feature-btn').click(function () {

                var val = $('#feature-add-title');
                var form_group = $('<div class="form-group feature-add-title-container">');
                var input = $('<input name="features[]" id="feature-add-title" class="form-input-full" value="' + val.val() + '" />');
                var btn_delete = '<span class="delete-feature-btn"><i class="fa fa-trash" aria-hidden="true"></i></span>';

                if (val.val() == '') {
                    alert('Please enter a title!')
                } else {
                    $('.featured-titles').append(form_group.append(input).append(btn_delete));
                }

                val.val("");
            });

            $(document).on('click', '.delete-feature-btn', function () {
                $(this).parent().remove();
            });
            /*ADD FEATURE SLIDER TITLES END*/

            /*DROPZONE START*/
            Dropzone.options.addImages = {
                addRemoveLinks: true,
                maxFilesize: 2,
                acceptedFiles: 'image/*',
                success: function (file, response) {
                    if (file.status == 'success') {
                        handleDropzoneFileUpload.handleSuccess(file);
                    } else {
                        handleDropzoneFileUpload.handleError(response);
                    }
                }
            };

            var handleDropzoneFileUpload = {
                handleError: function (response) {
                    console.log(response);
                },
                handleSuccess: function (file) {
                    var imageList = $('#offer-slider-images');

                    $(imageList).append('<div class="offer-slider-image"><div class="offer-image-overlay"><i class="fa fa-times-circle-o" aria-hidden="true"></i>Remove</div><img class="img-thumbnail" src="/images/uploads/offer-slider/' + file.name + '"></div>');
                    location.reload();
                }
            };
            /*DROPZONE END*/

            /*PREVIEW IMAGE ON UPLOAD START*/
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.upload-preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#page-cover-image").change(function () {
                readURL(this);
            });
            /*PREVIEW IMAGE ON UPLOAD END*/

            /*START - FILE DELETE MODAL*/
            $('.file_delete_modal').on('click', function () {
                //alert($(this).data('id'));
                var data_id = $(this).data('id');
                /* console.log(data_id)*/
                var url = "/dashboard/pages/update/offer-slider/delete/" + data_id;
                $("#remove_event_form").data('id', $(this).data('id'));
                $("#remove_event_form").attr('action', url);
                console.log($("#modal_file_delete").attr('action'));

                console.log($(this).data('id'));
                console.log($("#modal_file_delete").data('id'));
                //alert($("#modal_file_delete").data('file-id'));
                $('#openModal_file_delete').addClass('modalDialog_visible');
            });

            $('#closeModal_file_delete').on('click', function () {
                $('#openModal_file_delete').removeClass('modalDialog_visible');
            });

            $('#closeModal_file_delete_cancel').on('click', function () {
                $('#openModal_file_delete').removeClass('modalDialog_visible');
            });
            /*END - FILE DELETE MODAL*/

            /*CKEDITOR INIT */
            $(document).ready(function () {
                //Set the active menu state
                CKEDITOR.replace('sub_title');

                // SET NAV
                $("#pages").addClass('open');
                $("#pages").children('ul').slideDown();              
                //$("#about").addClass('active'); 
            });
            /*CKEDITOR INIT END*/
        </script>
    </section>
@endsection