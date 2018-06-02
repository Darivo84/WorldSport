@extends('admin.layout')
@section('content')

    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Contact
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
                    <form action="{{ route('admin_contact_update') }}" method="post" class="admin-form"
                          enctype="multipart/form-data">
                        <fieldset>
                            <legend>Update Contact Page:</legend>

                            <div class="form-group">
                                <label for="google_map_link">Google Map Link:</label>
                                <!-- <input type="file" name="cover_img" id="page-cover-image" class="form-input-full"> -->
                                <p><small>To update map, copy and paste google map embed code below.</small></p>
                                <input type="text" name="google_map_link" id="google_map_link" class="form-input-full" value="{{$contact[0]->google_map_link}}">
                            </div>


                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" id="address" class="form-input-full"
                                       value="{{$contact[0]->address}}">
                            </div>

                            <div class="form-group">
                                <label for="tel">Tel:</label>
                                <input type="text" name="tel" id="tel" class="form-input-full"
                                       value="{{$contact[0]->tel}}">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" class="form-input-full"
                                       value="{{$contact[0]->email}}">
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" cols="30" rows="10">{{$contact[0]->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="facebook_url">Facebook Url:</label>
                                <input type="text" name="facebook_url" id="facebook_url" class="form-input-full"
                                       value="{{$contact[0]->facebook_url}}">
                            </div>

                            <div class="form-group">
                                <label for="linked_in_url">Linked In Url:</label>
                                <input type="text" name="linked_in_url" id="linked_in_url" class="form-input-full"
                                       value="{{$contact[0]->linked_in_url}}">
                            </div>

                            <div class="form-group">
                                <label for="google_plus_url">Google+ Url:</label>
                                <input type="text" name="google_plus_url" id="google_plus_url" class="form-input-full"
                                       value="{{$contact[0]->google_plus_url}}">
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
                <h4 style="text-align: left; margin-top: 30px; margin-bottom: 10px;">Current Map</h4>
                {!! $contact[0]->google_map_link !!}
                <style>
                    iframe {
                        width: 100% !important;
                        height: 350px !important;
                    }
                </style>
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
                CKEDITOR.replace('description');

                // SET NAV
                $("#pages").addClass('open');
                $("#pages").children('ul').slideDown();              
                $("#contact_view_all").addClass('active');
            });
            /*CKEDITOR INIT END*/
        </script>
    </section>
@endsection