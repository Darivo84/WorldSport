@extends('admin.layout')
@section('content')

    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                    Pages
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                About Us
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
                    <form action="{{route('admin_about_update_insert')}}" method="post" class="admin-form"
                          enctype="multipart/form-data">
                        <fieldset>
                            <legend>Update Page:</legend>

                            <div class="form-group">
                                <label for="page-title">Title:</label>
                                <input type="text" name="title" id="page-title" class="form-input-full"
                                       value="{{$contact->title}}">
                            </div>

                            <div class="form-group">
                                <label for="page-sub-title">Subtitle:</label>
                                <textarea name="subtitle" id="page-sub-title"
                                          style="width: 100%;box-sizing: border-box;font-family: Roboto;font-size: 16px;"
                                          rows="6">{{$contact->subtitle}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="page-cover-image">Cover Image:</label>
                                <p><small>Optimal photo dimensions: 1000 pixels by 260 pixels landscape</small></p>
                                <input type="file" name="cover_img" id="cover-image" class="form-input-full" >
                            </div>

                            <div class="form-group">
                                <label for="page-cover-image">Our Events Image:</label>
                                <p><small>Optimal photo dimensions: 960 pixels by 430 pixels landscape</small></p>
                                <input type="file" name="events_img" id="events-image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="page-cover-image">Our Events Image Mobile:</label>
                                <p><small>Optimal photo dimensions: 500 pixels width portrait</small></p>
                                <input type="file" name="events_img_mobi" id="events-image-mobi" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="page-footer-image">Footer Image:</label>
                                <p><small>Optimal photo dimensions: 1000 pixels by 415 pixels landscape</small></p>
                                <input type="file" name="footer_img" id="footer-image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="page-sub-title">What We Do:</label>
                                <textarea name="what_we_do" id="what_we_do"
                                          style="width: 100%;box-sizing: border-box;font-family: Roboto;font-size: 16px;"
                                          rows="6">{{$contact->what_we_do}}</textarea>
                            </div>

                            <div class="form-group clearfix">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" value="Update" class="btn-blue">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="preview-pane">
                <div class="cover_image_container">
                    <h4 style="text-align: left">Cover Image</h4>
                    <img src="{{ $contact->cover_img ? $contact->cover_img :  '/images/no-preview-big.jpg'}}"
                         alt="" class="cover-preview">
                </div>

                <div class="brand_image_container">
                    <h4 style="text-align: left">Our Events Image</h4>
                    <img src="{{ $contact->events_img ? $contact->events_img :  '/images/no-preview-big.jpg'}}"
                         alt="" class="events-preview">
                </div>

                <div class="info_image_container">
                    <h4 style="text-align: left">Footer Image</h4>
                    <img src="{{ $contact->footer_img ? $contact->footer_img :  '/images/no-preview-big.jpg'}}"
                         alt="" class="footer-preview">
                </div>

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

            $("#cover-image").change(function () {
                readURL(this, 'cover');
            });

            $("#events-image").change(function () {
                readURL(this, 'events');
            });


            $("#footer-image").change(function () {
                readURL(this, 'footer');
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
                CKEDITOR.replace('what_we_do');

                // SET NAV
                $("#pages").addClass('open');
                $("#pages").children('ul').slideDown();              
                $("#about").addClass('active');
                
            });
            /*CKEDITOR INIT END*/
        </script>
    </section>
@endsection