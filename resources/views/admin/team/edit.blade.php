@extends('admin.layout')
@section('content')

    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Team
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                Update
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                {{$team_member->first_name . ' ' . $team_member->last_name}}
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

                    <form action="{{route('admin_team_update',  $team_member->id)}}" method="post" class="admin-form"
                          enctype="multipart/form-data">
                        <fieldset class="">
                            <legend>Update Team Member:</legend>

                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" name="first_name" id="first_name" class="form-input-full"
                                       value="{{$team_member->first_name}}">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Surname:</label>
                                <input type="text" name="last_name" id="last_name" class="form-input-full"
                                       value="{{$team_member->last_name}}">
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="form-input-full"
                                       value="{{$team_member->title}}">
                            </div>

                            <div class="form-group">
                                <label for="image">Profile Picture:</label>
                                <p><small>Optimal photo dimensions: 200 pixels by 240 pixels portrait</small></p>
                                <input type="file" name="image" id="image" class="form-input-full">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" class="form-input-full"
                                       value="{{$team_member->email}}">
                            </div>

                            <div class="form-group">
                                <label for="linkedin_url">Linkedin Url:</label>
                                <input type="text" name="linkedin_url" id="linkedin_url" class="form-input-full"
                                       value="{{$team_member->linkedin_url}}">
                            </div>

                            <div class="form-group clearfix">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" value="Update" class="btn-blue  push-right">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="preview-pane">
                <img src="{{ $team_member->image ? $team_member->image :  '/images/no-preview-big.jpg'}}"
                     alt="" class="upload-preview">
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

        $("#image").change(function () {
            readURL(this);
        });

        $(document).ready(function () {
            //Set the active menu state
            //CKEDITOR.replace('description');

            // SET NAV
                $("#team").addClass('open');
                $("#team").children('ul').slideDown();              
                $("#team_view_all").addClass('active');
        });
    </script>
@endsection