@extends('layouts.default')
@section('content')
    <div class="col-sm-12 col-md-12">
        <div class="table-section">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 35px;">ID</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Project URL') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- class="active-tr" -->
                        @for($i = 0; $i < sizeof($projects); $i++)
                            <tr class="tbl_row" data-id="{{ $projects[$i]->id }}">
                                <td style="text-align: center;">{{ $i + 1 }}</td>
                                <td>{{ $projects[$i]->title }}</td>
                                <td>{{ url(Auth::user()->name.'/'.$projects[$i]->title.'/index.html') }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!--table-section-->
    </div><!--col-12-->

    <div class="bottom-btns project-list-btns">
        <a href="project/create" class="save-btn ic-save"><span>{{ __('Add Project') }}</span></a>
        <a href="javascript:void(0);" class="add-video-btn ic-edit-project"><span>{{ __('Edit Project') }}</span></a>
        <a href="javascript:void(0);" class="del-video-btn ic-delete-video"><span>{{ __('Delete Project') }}</span></a>
    </div>

    <script>
        $(function() {
            $('.tbl_row').click(function(){
                $('.tbl_row').removeClass('active-tr');
                $(this).addClass('active-tr');
            });

            $('.tbl_row').dblclick(function() {
                window.location.href = "{{ url('/project/edit') }}/" + $(this).data('id');
            });

            $('.ic-edit-project').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value){
                        window.location.href = "{{ url('/project/edit') }}/" + $(this).data('id');
                    });
                } else {
                    swal("{{ __('Please select project to edit') }}", {
                        icon:"error"
                    });
                }
            });

            $('.ic-delete-video').click(function () {
                if ($('tbody>tr').hasClass('active-tr')) {
                    $('.active-tr').each(function(index, value) {
                        var id = $(this).data('id');
                        swal({
                            title: "Project",
                            text: "{{ __('Do you really want to delete this?') }}",
                            icon: "error",
                            buttons: true,
                            dangerMode: true
                        }).then(function(result) {
                            if (result) {
                                $('#id').val(id);

                                $.get('/project/destroy/' + id,  function (response) {
                                    if (response.result == 'success') {
                                        $('tr[data-id="' + response.id + '"]').remove();
                                        swal("Project", "{{ __('Playlist successfully deleted') }}", "success");
                                    } else {
                                        swal("Project", "{{ __('Deleting playlist failed') }}", "error");
                                    }
                                });
                            }
                        });
                    });
                } else {
                    swal("{{ __('Please select project to delete') }}",{
                        icon:"error",
                    });
                }
            });
        });
    </script>
@stop