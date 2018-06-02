@extends('admin.layout')
@section('content')

    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Case Studies
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Update
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                {{ $case_study->title }}
            </h2>
        </div>

        <div class="section-content">
            <div class="notification-box">
                @if(Session::has('success'))
                    <div class="success_box"><i class="fa fa-check"></i>{{ Session::get('success') }}</div>

                    <script>
                        setTimeout(function () {
                            $(document).ready(function () {
                                $('.success_box').fadeOut(1000);
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
                    <form action="{{route('admin_case_studies_update', $case_study->id)}}" method="post"
                          class="admin-form"
                          enctype="multipart/form-data">
                        <fieldset class="">
                            <legend>Update Case Study:</legend>

                            <div class="form-group">
                                <label for="news-title">Title:</label>
                                <input type="text" name="title" id="news-title" class="form-input-full"
                                       value="{{$case_study->title}}">
                            </div>

                            <div class="form-group">
                                <label for="event_page">Select Client:</label>
                                <select class="form-input-full" name="client">
                                    <option selected value="{{ $selected_client->id }}"
                                            class="page_item">{{ $selected_client->name }}</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="event_page">Select Layout:</label>
                                <p style="display: inline-block; padding-right:10px;">
                                    <img src="/images/option1.jpg" style="width:100px;"><br>
                                    <small>300px by 200px</small><br>
                                    Option 1: <input type="radio" name="width" value="0" <?php echo $case_study->width == 0 ? 'checked' : '';?>>
                                </p>                                

                                <p style="display: inline-block; padding-right:10px;">
                                    <img src="/images/option2.jpg" style="width:100px;"><br>
                                    <small>600px by 200px</small><br>
                                    Option 2: <input type="radio" name="width" value="1" <?php echo $case_study->width == 1 ? 'checked' : '';?>>
                                </p>                                

                                <p style="display: inline-block;">
                                    <img src="/images/option3.jpg" style="width:100px;"><br>
                                    <small>900px by 200px</small><br>
                                    Option 3: <input type="radio" name="width" value="2" <?php echo $case_study->width == 2 ? 'checked' : '';?>>
                                </p> 

                                <div class="form-group">
                                    <label for="news-title">Case Study Image:</label>
                                    <input type="file" name="cs_image" id="cs_image" class="form-input-full">
                                </div>                               
                            </div>                            

                            <div class="form-group">
                                <label for="event_page" style="display: inline-block; margin-right: 10px;">Select Categories:</label><span style="font-size: 14px; color: #707070;"> (To add a category, select one from the drop down list and click the add category button below.)</span>
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
                                    <label for="event_page" style="display: inline-block; margin-right: 10px;">Selected Categories:</label><span style="font-size: 14px; color: #707070;"> (To remove a category, click on the red trash icon to the right.)</span>
                                </div>

                                @foreach($selected_pages as $page)
                                    <div class="form-group feature-add-title-container">
                                        <input readonly id="feature-add-title" class="form-input-full"
                                               value="{{ $page->name }}"/>
                                        <input type="hidden" name="page_id[]" class="form-input-full"
                                               value="{{ $page->page_id }}"/>
                                        <span class="delete-feature-btn"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                    </div>
                                @endforeach
                            </div>

                            <script>
                                $('.add_category_btn').click(function () {
                                    var val = $('#page_value').find(':selected');

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
                                <p><small>Optimal photo dimensions: 1000 pixels by 260 pixels landscape</small></p>
                                <input type="file" name="cover_image" id="cover_image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">Brand Image:</label>
                                <p><small>Optimal photo dimensions: 300 pixels by 300 pixels</small></p>
                                <input type="file" name="brand_image" id="brand_image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">Information Image:</label>
                                <p><small>Optimal photo dimensions: 960 pixels by 430 pixels landscape</small></p>
                                <input type="file" name="info_image" id="info_image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">Information Image Mobile:</label>
                                <p><small>Optimal photo dimensions: 500 pixels width portrait</small></p>
                                <input type="file" name="info_image_mobi" id="info_image_mobi" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="news-title">Description:</label>
                                <textarea name="description" id="news-title" cols="30" rows="10">{{$case_study->description}}</textarea>
                            </div>

                            <h4>Digital Links</h4>
                            <div class="form-group">
                                <label for="web_url">Web:</label>
                                <input type="text" name="web_url" id="web_url" class="form-input-full"  value="{{ $case_study->web_url }}">
                            </div>

                            <div class="form-group">
                                <label for="facebook_url">Facebook:</label>
                                <input type="text" name="facebook_url" id="facebook_url" class="form-input-full" value="{{ $case_study->facebook_url }}">
                            </div>

                            <div class="form-group">
                                <label for="twitter_url">Twitter:</label>
                                <input type="text" name="twitter_url" id="twitter_url" class="form-input-full" value="{{ $case_study->twitter_url }}">
                            </div>

                            <div class="form-group">
                                <label for="instagram_url">Instagram:</label>
                                <input type="text" name="instagram_url" id="instagram_url" class="form-input-full" value="{{ $case_study->instagram_url }}">
                            </div>

                            <div class="form-group">
                                <label for="pinterest_url">Pinterest:</label>
                                <input type="text" name="pinterest_url" id="pinterest_url" class="form-input-full" value="{{ $case_study->pinterest_url }}">
                            </div>

                            <div class="form-group clearfix">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" value="Update" class="btn-blue  push-right">
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div class="form-container">
                    <fieldset>
                        <legend>Update Case Study Gallery:</legend>
                        <form action="{{url('/dashboard/case-studies/update/gallery/upload/' .$case_study->id)}}"
                              class="dropzone" id="addImages" method="post">

                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </form>
                        <br>

                        <?php $width_count = 0;  ?>
                        @if(isset($gallery_photos))
                            @foreach($gallery_photos as $photo)

                            @endforeach
                        @endif
                        <?php if( $width_count != 0){  ?> <p style="color: red">  "Some of your images do not have a layout option." </p> <?php };  ?>

                        <div id="offer-slider-images">
                            @if(isset($gallery_photos))
                                @foreach($gallery_photos as $photo)
                                    <div class="offer-slider-image">
                                        <div class="offer-image-overlay">
                                            <div class="file_delete_modal" data-id="{{$photo['id']}}" ><i class="fa fa-times-circle-o i-red" aria-hidden="true"></i></div>
                                            <div class="file_edit_modal" data-id="{{$photo['id']}}" data-width="{{$photo->width}}"><i class="fa fa-pencil-square-o i-green" aria-hidden="true"></i> </div>
                                        </div>
                                        <img class="img-thumbnail" src="{{ $photo->image_url }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="preview-pane">
                <div class="cover_image_container">
                    <h4 style="text-align: left">Cover Image</h4>
                    <img src="{{ $case_study->cover_img_url ? $case_study->cover_img_url :  '/images/no-preview-big.jpg'}}"
                         alt="" class="cover-preview">
                </div>

                <div class="brand_image_container">
                    <h4 style="text-align: left">Brand Image</h4>
                    <img src="{{ $case_study->brand_img_url ? $case_study->brand_img_url :  '/images/no-preview-big.jpg'}}"
                         alt="" class="brand-preview">
                </div>

                <div class="info_image_container">
                    <h4 style="text-align: left">Information Image</h4>
                    <img src="{{ $case_study->info_img_url ? $case_study->info_img_url :  '/images/no-preview-big.jpg'}}"
                         alt="" class="info-preview">
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

                <form action="/dashboard/case-studies/gallery/delete/" id="remove_event_form" method="post">
                    <button type="submit" data-id="" class="btn-red" id="modal_file_delete">Delete</button>
                    <button type="button" class="btn-blue" id="closeModal_file_delete_cancel">Cancel</button>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="event_remove_id" class="event_remove_id">
                </form>
            </div>
        </div>
        <!-- END - FILE DELETE MODAL -->

        <!-- START - FILE DELETE MODAL -->
        <div id="openModal_file_edit" class="modalDialog">
            <div>
                <a href="javascript:void(0);" title="Close" class="close" id="closeModal_file_edit">X</a>
                <h2>Please select a layout option</h2>

                <form action="/dashboard/case-studies/gallery/photo/edit/" id="edit_event_form" method="post">

                    <div class="form-group">
                        <p style="display: inline-block; padding-right: 10px;">
                            <img src="/images/option1.jpg" style="width:100px;"><br>
                            <small>300px by 200px</small><br>
                            Option 1: <input type="radio" name="width" class="photo-width" value="0">
                        </p>                        

                        <p style="display: inline-block; padding-right: 10px;">
                            <img src="/images/option2.jpg" style="width:100px;"><br>
                            <small>600px by 200px</small><br>
                            Option 2: <input type="radio" name="width" class="photo-width" value="1">
                        </p>                        

                        <p style="display: inline-block;">
                            <img src="/images/option3.jpg" style="width:100px;"><br>
                            <small>900px by 200px</small><br>
                            Option 3: <input type="radio" name="width" class="photo-width" value="2">
                        </p>
                        
                    </div>

                    <button type="submit" data-id="" class="btn-green" id="modal_file_edit">Save</button>
                    <button type="button" class="btn-blue" id="closeModal_file_edit_cancel">Cancel</button>

                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="event_edit_id" class="event_edit_id">
                </form>
            </div>
        </div>
        <!-- END - FILE DELETE MODAL -->


    </section>
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

                $(imageList).append('<div class="offer-slider-image"><div class="offer-image-overlay"><i class="fa fa-times-circle-o" aria-hidden="true"></i>Remove</div><img class="img-thumbnail" src="/images/uploads/case-study/' + file.name + '"></div>');
                location.reload();
            }
        };
        /*DROPZONE END*/

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


/*      $("input[class='photo-width']").each(function(){
          if($(this).attr('checked') != 'checked'){
              console.log('not checked');
          }else{
              console.log('checked');
          }
      });*/




        /*START - FILE DELETE MODAL*/
        $('.file_edit_modal').on('click', function () {
            //alert($(this).data('id'));
            var data_id = $(this).data('id');
            var data_width = $(this).data('width');
            console.log(data_id);
            console.log(data_width);
            var url = "/dashboard/case-studies/gallery/photo/edit/" + data_id;

            if(data_width == 0 || data_width == 1 || data_width == 2){
                var photo = $("[class=photo-width][value=" + data_width + "]");

                photo.attr('checked', true);
            } else {
                var photo = $("[class=photo-width][value=0]");

                photo.attr('checked', true);
            }

            $("#edit_event_form").data('id', $(this).data('id'));
            $("#edit_event_form").attr('action', url);
            console.log($("#modal_file_edit").attr('action'));

            console.log($(this).data('id'));
            console.log($("#modal_file_edit").data('id'));
            //alert($("#modal_file_delete").data('file-id'));
            $('#openModal_file_edit').addClass('modalDialog_visible');
        });

        $('#closeModal_file_edit').on('click', function () {
            $('#openModal_file_edit').removeClass('modalDialog_visible');
        });

        $('#closeModal_file_edit_cancel').on('click', function () {
            $('#openModal_file_edit').removeClass('modalDialog_visible');
        });

        /*START - FILE DELETE MODAL*/
        $('.file_delete_modal').on('click', function () {
            //alert($(this).data('id'));
            var data_id = $(this).data('id');
            /* console.log(data_id)*/
            var url = "/dashboard/case-studies/gallery/delete/" + data_id;
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

        $(document).ready(function () {
            //Set the active menu state
            CKEDITOR.replace('description');

            // SET NAV
                $("#case_study").addClass('open');
                $("#case_study").children('ul').slideDown();              
                $("#case_study_view_all").addClass('active');
        });
    </script>
@endsection