@extends('admin.layout')
@section('content')

    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Pages
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Home
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
                    @if(isset($home_slider) && $home_slider != null)
                        <fieldset>
                            <legend>Update Offer Image Slider:</legend>

                            <form action="{{url('/dashboard/pages/update/home-slider/upload/')}}"
                                  class="dropzone" id="addImages" method="post">

                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </form>
                            <br>
                            <div id="offer-slider-images">
                                @foreach($home_slider as $slider)
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
                <h4 style="text-align: left; margin-top: 30px; margin-bottom: 10px;">File Info</h4>
                <ul style="text-align: left;">
                    <li style="margin-bottom: 8px;">Max file size: 2mb</li>
                    <li style="margin-bottom: 8px;">Supported File Types: jpg, jpeg, tif, png, gif</li>
                    <li style="margin-bottom: 8px;">Optimal photo dimensions: 1980 pixels by 1080 pixels landscape</li>
                </ul>
            </div>
        </div>



        <!-- START - FILE DELETE MODAL -->
        <div id="openModal_file_delete" class="modalDialog">
            <div>
                <a href="javascript:void(0);" title="Close" class="close" id="closeModal_file_delete">X</a>
                <h2>Are you sure you would like to delete this Event?</h2>

                <form action="/dashboard/pages/update/home-slider/delete/" id="remove_event_form" method="post">
                    <button type="submit" data-id="" class="btn-red" id="modal_file_delete">Delete</button>
                    <button type="button" class="btn-blue" id="closeModal_file_delete_cancel">Cancel</button>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="event_remove_id" class="event_remove_id">
                </form>
            </div>
        </div>
        <!-- EMD - FILE DELETE MODAL -->

        <script>

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

            /*PREVIEW IMAGE ON UPLOAD END*/

            /*START - FILE DELETE MODAL*/
            $('.file_delete_modal').on('click', function () {
                //alert($(this).data('id'));
                var data_id = $(this).data('id');
                /* console.log(data_id)*/
                var url = "/dashboard/pages/update/home-slider/delete/" + data_id;
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

            // SET NAV
                $("#pages").addClass('open');
                $("#pages").children('ul').slideDown();              
                $("#home").addClass('active');

            /*CKEDITOR INIT END*/
        </script>
    </section>
@endsection