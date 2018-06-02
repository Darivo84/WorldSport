@extends('admin.layout')
@section('content')
    <section>
        <div class="admin-bread-crumbs">
            <h2 class="content-heading" style="margin: 0; color: #fff;">
                <a href="/dashboard" class='breadcrumbs'><i class="fa fa-home"></i></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i> Case Studies
            </h2>
        </div>

        <div class="section-content">
            @if(in_array('create_news', $user->permissions()))
                <div class="add-box">
                    <a href="{{route('admin_case_studies_create')}}" class="input-btn" id="add_file">
                        <span class="btn-blue">Add New</span>
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

            <!-- ERRORS -->
                @if ( $errors->count() > 0 )
                    <div id='error'>
                        <p>The following errors have occurred:</p>

                        @foreach( $errors->all() as $message )
                            <div class="alert box">
                                <i class="fa fa-ban"></i>{{ $message }}<i class="fa fa-times message-close"></i>
                            </div>
                        @endforeach
                    </div>

                    <div>
                        <br class="clear-l">
                    </div>
                @endif
            </div>

            <table cellspacing='0' id="table">
                <thead>
                <tr class="table-headings">
                    <!-- <th>Preview</th> -->
                    <th style="width: 300px;text-align: left;">Title</th>
                    <th style="width: 300px;text-align: left;">Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($case_studies as $case_study)
                    <tr>

                        <td>{{$case_study->title}}</td>
                        <td>{{$case_study->created_at}}</td>
                        <td style="width: 100px;text-align: right;">
                            @if(in_array('update_case_study', $user->permissions()))
                                <a href="{{url('/dashboard/case-studies/update/' . $case_study->id)}}"
                                   class="input-btn blue-btn"><i class="fa fa-pencil-square-o"></i>
                                    <p class="display_none">Edit</p></a>
                            @endif
                            @if(in_array('delete_case_study', $user->permissions()))
                                <a href="javascript:void(0);" class="input-btn red-btn file_delete_modal"
                                   data-id="{{$case_study->id}}">       <i class="fa fa-trash" style="color:#A94442;"
                                                                           aria-hidden="true"></i>
                                    <p class="display_none">Delete</p></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $case_studies->links() }}
            </div>
        </div>

        <!-- START - PREVIEW MODAL -->
        <!-- START - FILE DELETE MODAL -->
        <div id="openModal_file_delete" class="modalDialog">
            <div>
                <a href="javascript:void(0);" title="Close" class="close" id="closeModal_file_delete">X</a>
                <h2>Are you sure you would like to delete this Case Study?</h2>

                <form action="/dashboard/case-studies/delete" id="remove_event_form" method="post">
                    <button type="submit" data-id="" class="btn-red" id="modal_file_delete">Delete</button>
                    <button type="button" class="btn-blue" id="closeModal_file_delete_cancel">Cancel</button>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="event_remove_id" class="event_remove_id">
                </form>
            </div>
        </div>
        <!-- EMD - FILE DELETE MODAL -->
    </section>
    <script>

        /*START - FILE DELETE MODAL*/
        $('.file_delete_modal').on('click', function () {
            //alert($(this).data('id'));
            var data_id = $(this).data('id');
            console.log(data_id)
            var url = "/dashboard/case-studies/delete/" + data_id;
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
        $("#case_study").addClass('open');
        $("#case_study").children('ul').slideDown();              
        $("#case_study_view_all").addClass('active');

    </script>
@endsection